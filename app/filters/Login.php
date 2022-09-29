<?php
namespace app\filters;

#[\Attribute]
class Login extends \app\core\AccessFilter{

	public function execute(){
		if(!isset($_SESSION['user_id'])){
			header('location:/User/index?error=You must log in to use these features!');
			return true;
		}
		return false;
	}

}