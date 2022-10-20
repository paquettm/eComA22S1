<?php
namespace app\core;

abstract class Validator{
	abstract public function isValidData($data);
}