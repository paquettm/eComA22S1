<?php
namespace app\filters;

#[\Attribute]
class Admin extends \app\core\AccessFilter{
	public function execute(){
		if($_SESSION['role']!='admin'){
			header('location:/User/account?error=Your account does not have admin privileges.');
			return true;
		}
		return false;
	}
}

?>