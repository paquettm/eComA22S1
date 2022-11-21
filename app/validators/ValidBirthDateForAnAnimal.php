<?php
namespace app\validators;

#[\Attribute]
class ValidBirthDateForAnAnimal extends \app\core\Validator{

	public function isValidData($data){
		$now = date_create();
		$then = date_create($data);
		$interval = date_diff($now, $then);
		return $interval->y < 500;
	}

}