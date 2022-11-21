<?php
namespace app\validators;
use \app\core\ValidationResult;

#[\Attribute]
class NoFuture implements \app\core\Validator{
	public function isValidData($data): ValidationResult{
		$now = date_create();
		$then = date_create($data);
		$test = $then<$now;
		$message = ($test?'':'Future dates are condidered invalid in this context.');
		return new ValidationResult($test,$message,$data);
	}
}