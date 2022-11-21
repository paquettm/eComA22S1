<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class ConfirmValue implements \app\core\Validator{
	public function isValidData($values): ValidationResult{
		$value = $values[0];
		$test = true;
		foreach ($values as $other) {
			$test = $test && ($value == $other);
		}
		$message = ($test?'':'Values must be the same.');
		return new ValidationResult($test,$message,$values);
	}
}