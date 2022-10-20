<?php
namespace app\validators;

#[\Attribute]
class Email extends \app\core\Validator{
	public function isValidData($data){
		return filter_var($data, FILTER_VALIDATE_EMAIL);
	}
}