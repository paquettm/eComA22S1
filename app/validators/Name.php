<?php
namespace app\validators;
use \app\core\ValidationResult;
#[\Attribute]
class Name implements \app\core\Validator{
	public function isValidData($data) : ValidationResult{
		$test = preg_match('/\w+/u', $data) != false;
		$message = ($test?'':'Names are expected to contain at least one character.');
		return new ValidationResult($test,$message,$data);
	}
}