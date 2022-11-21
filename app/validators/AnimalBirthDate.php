<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class AnimalBirthDate implements \app\core\Validator{
	public function isValidData($data): ValidationResult{
		$now = date_create();
		$then = date_create($data);
		$diff = date_diff($now, $then);
		$test = $diff->y < 500;
		$message = ($test?'':'Animals older than 500 years may not be recorded.');
		return new ValidationResult($test,$message,$data);
	}
}