<?php
namespace app\validators;

#[\Attribute]
class NonEmpty extends \app\core\Validator{
	public function isValidData($data){
		return !empty($data);
	}
}