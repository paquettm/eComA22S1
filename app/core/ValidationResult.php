<?php
namespace app\core;

class ValidationResult{
	private $isValid;
	private $errorMessage;
	private $value;

	public function __construct($validity, $error, $value){
		$this->isValid = $validity;
		$this->errorMessage = $error;
		$this->value = $value;
	}

	public function isValid(){
		return $this->isValid;
	}

	public function __toString(){
		return $this->errorMessage;
	}

	//There may be more than one validator on a field
	public function add(ValidationResult $more){
		$this->isValid = $this->isValid && $more->isValid;
		$this->errorMessage .= $more->errorMessage;
	}
}