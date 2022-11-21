<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class Email implements \app\core\Validator{
	public function isValidData($data): ValidationResult{
		$test = filter_var($data, FILTER_VALIDATE_EMAIL);
		$message = ($test?'':'Correct email address expected.');
		return new ValidationResult($test,$message,$data);
	}
}