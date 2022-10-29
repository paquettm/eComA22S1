<?php
namespace app\core;

class ValidationResult{
	public $isValid;
	public $errorMessage;
	public function __construct($validity, $error){
		$this->isValid = $validity;
		$this->errorMessage = $error;
	}
	public function __invoke(){
		return $this->isValid;
	}
	public function __toString(){
		return $this->errorMessage;
	}
	public function add(ValidationResult $more){
		$this->isValid = $this->isValid && $more->isValid;
		$this->errorMessage .= $more->errorMessage;
	}
}