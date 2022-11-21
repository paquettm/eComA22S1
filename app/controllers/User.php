<?php
namespace app\controllers;

class User extends \app\core\Controller{
	//log users in here
	public function index(){
		if(isset($_POST['action'])){
			//select the user record as per the request
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);
			//verify the password match
			if(password_verify($_POST['password'], $user->password_hash)){
				//correct password provided
				$_SESSION['username'] = $user->username;
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['role'] = $user->role;
				$_SESSION['secret_key'] = $user->secret_key;
				header('location:/User/account');
			}else{
				//incorret password provided
				header('location:/User/index?error=Incorrect username/password combination!');
			}
		}else{
			$this->view('User/index');
		}
	}

	public function check2fa(){
		if(!isset($_SESSION['user_id'])) header('location:/User/index');
		if(isset($_POST['action'])){
			$currentcode = $_POST['currentcode'];
			if(\app\core\TokenAuth6238::verify(
				$_SESSION['secret_key'],$currentcode)){
				$_SESSION['secret_key'] = null;
				header('location:/User/account');
			}
		}else{
			$this->view('User/check2fa');
		}
	}

	//GOAL #[Attribute] to provide authentication service
	#[\app\filters\Login]
	public function account(){
		if(isset($_POST['action'])){
			//we submit the password modification form
			$user = new \app\models\User();
			$user = $user->get($_SESSION['username']);
			if(password_verify($_POST['old_password'],$user->password_hash)){
				//old password matches
				$user->password = [$_POST['password'], $_POST['password_confirm']];
				if($user->updatePassword()->isValid()){
					header('location:/User/account?message=Password modified.');
				}else{
					unset($user->password);
					\app\core\Model::$input = $user;
					$this->view('User/account');
				}
			}else{
				header('location:/User/account?error=Wrong password provided. Password unchanged.');
			}
		}else
			$this->view('User/account');
	}

	public function logout(){
		session_destroy();
		header('location:/User/index?message=You\'ve been successfully logged out.');
	}

	//process of requesting the username and password wanted by the user
	public function register(){
		//when we submit the form
		if(isset($_POST['action'])){
			//verify that the password and password_confirmation match
			//proceed with attempting registration
			$user = new \app\models\User();
			$user->username = $_POST['username'];
			$user->password = [$_POST['password'], $_POST['password_confirmation']];

			if($user->insert()->isValid()){
				header('location:/User/index');
				return;
			}
			unset($user->password);
			\app\core\Model::$input = $user;
			$this->view('User/register');
		}else{
			//show the registration form
			$this->view('User/register');
		}
	}

	public function makeQRCode(){
		$data = $_GET['data'];
		\QRcode::png($data);
	}
//http://localhost/User/makeQRCode?data=otpauth://totp/Tarzan@Example.com%3Fsecret%3DU6BALU26GH4KI5YY%26issuer%3DAwesome%20Example%20App
	#[\app\filters\Login]
	public function setup2fa(){
		if(isset($_POST['action'])){
			$currentcode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify(
				$_SESSION['secretkey'],$currentcode)){
				//the user has verified their proper 2-factor authentication setup
				$user = new \App\models\User();
				$user->user_id = $_SESSION['user_id'];
				$user->secret_key = $_SESSION['secretkey'];
				$user->update2fa();
				header('location:/User/account');
			}else{
				header('location:/User/setup2fa?error=token not verified!');//reload
			}
		}else{
			$secretkey = \App\core\TokenAuth6238::generateRandomClue();
			$_SESSION['secretkey'] = $secretkey;
			$url = \app\core\TokenAuth6238::getLocalCodeUrl(
				$_SESSION['username'],
				'Example.com',
				$secretkey,
				'Awesome Example App');
			$this->view('User/twoFASetup', $url);
		}
	}


}
