<?php
namespace app\controllers;

class User extends \app\core\Controller{
<<<<<<< HEAD
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
=======

	public function index(){//login page
		if(isset($_POST['action'])){
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);
			if(password_verify($_POST['password'], $user->password_hash)){
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
>>>>>>> bb75fd58676df6ed82e0d2978003d2f0893b8a65
				$_SESSION['role'] = $user->role;
				$_SESSION['secret_key'] = $user->secret_key;
				header('location:/User/account');
			}else{
<<<<<<< HEAD
				//incorret password provided
				header('location:/User/index?error=Incorrect username/password combination!');
=======
				header('location:/User/index?error=Wrong username/password combination!');
>>>>>>> bb75fd58676df6ed82e0d2978003d2f0893b8a65
			}
		}else{
			$this->view('User/index');
		}
	}

<<<<<<< HEAD
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
=======
	#[\app\filters\Login]
	public function account(){
		//password modification
		if(isset($_POST['action'])){
			//check the old password
			$user = new \app\models\User();
			$user = $user->get($_SESSION['username']);
			if(password_verify($_POST['old_password'],$user->password_hash)){
				if($_POST['password'] == $_POST['password_confirm']){
					$user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$user->updatePassword();
					header('location:/User/account?message=Password changed successfully.');
				}else{
					header('location:/User/account?error=Passwords do not match.');
				}
			}else{
				header('location:/User/account?error=Wrong old password provided.');
			}
		}else{
			$this->view('User/account');
		}
>>>>>>> bb75fd58676df6ed82e0d2978003d2f0893b8a65
	}

	public function logout(){
		session_destroy();
<<<<<<< HEAD
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
=======
		header('location:/User/index');
	}

	public function register(){
		if(isset($_POST['action'])){//form submitted

			if($_POST['password'] == $_POST['password_confirm']){//match
				$user = new \app\models\User();//TODO
				$check = $user->get($_POST['username']);
				if(!$check){
					$user->username = $_POST['username'];
					$user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$user->insert();
					header('location:/User/index');
				}else{
					header('location:/User/register?error=The username "'.$_POST['username'].'" is already in use. Select another.');
				}
			}else{
				header('location:/User/register?error=Passwords do not match.');
			}

		}else{
			$this->view('User/register');
		}

	}

	#[\app\filters\Admin]
	public function admin(){
		echo "Yay!";
>>>>>>> bb75fd58676df6ed82e0d2978003d2f0893b8a65
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
