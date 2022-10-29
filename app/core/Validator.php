<?php
namespace app\core;
use \app\core\ValidationResult;

interface Validator{
	public function isValidData($data): ValidationResult;
}