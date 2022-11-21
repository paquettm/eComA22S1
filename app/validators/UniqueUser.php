<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class UniqueUser implements \app\core\Validator{
	public function __construct($something){}


	public function isValidData($username): ValidationResult{
		$user = new \app\models\User();
		$user = $user->get($username);
		$test = $user == null;
		$message = ($test?'':'The Username ' . $username . ' is already in use. Please select another.');
		return new ValidationResult($test,$message,$username);
	}
}