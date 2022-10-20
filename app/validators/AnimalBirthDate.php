<?php
namespace app\validators;

#[\Attribute]
class AnimalBirthDate extends \app\core\Validator{
	public function isValidData($data){
		$now = date_create();
		$then = date_create($data);
		$diff = date_diff($now, $then);
		return $diff->y < 500;
	}
}