<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class NonEmpty implements \app\core\Validator{
	public function isValidData($data) : ValidationResult{
		$test = !empty($data);
		$message = ($test?'':'Nonempty data expected.');
		return new ValidationResult($test,$message,$data);
	}
}