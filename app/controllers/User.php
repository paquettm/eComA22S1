<?php
namespace app\controllers;

class User extends \app\core\Controller{

	public function index(){//login page
		if(isset($_POST['action'])){
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);
			if(password_verify($_POST['password'], $user->password_hash)){
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
				$_SESSION['role'] = $user->role;
				$_SESSION['secret_key'] = $user->secret_key;
				header('location:/User/account');
			}else{
				header('location:/User/index?error=Wrong username/password combination!');
			}
		}else{
			$this->view('User/index');
		}
	}

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
	}

	public function logout(){
		session_destroy();
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
	}

	public function makeQRCode(){
		$data = $_GET['data'];
		\QRcode::png($data);
	}

	#[\app\filters\Login]
	public function setup2fa(){
		if(isset($_POST['action'])){
			//verification of the code sent by the user
			$currentCode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify($_SESSION['secretkey'],$currentCode)){
				$user = new \app\models\User();
				$user->user_id = $_SESSION['user_id'];
				$user->secret_key = $_SESSION['secretkey'];
				$user->update2fa();
				header('location:/User/account');
			}else{
				header('location:/User/setup2fa?error=Wrong code provided');
			}
		}else{
			$secretkey = \App\core\TokenAuth6238::generateRandomClue();
			$_SESSION['secretkey'] = $secretkey;
			$url = \app\core\TokenAuth6238::getLocalCodeUrl(
				$_SESSION['username'],
				'Awesome.com',
				$secretkey,
				'Awesome App');
			$this->view('User/twofasetup', $url);

		}
	}

	function check2fa(){
		if(!isset($_SESSION['user_id'])){
			header('location:/User/index');
			return;
		}
		//if the form is sent
		if(isset($_POST['action'])){
			$currentCode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify($_SESSION['secret_key'],$currentCode)){
				$_SESSION['secret_key']=null;
				header('location:/User/account');
			}else{
				session_destroy();
				header('location:/User/index');
			}
		}else{
			$this->view('User/check2fa');
		}
	}

}