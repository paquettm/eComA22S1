<?php
namespace app\core;

class ValidationResultSet{
	private $isValid;
	private $results;//array(fieldName=>ValidationResult)
	
	public function __construct(){
		$this->isValid = true;
		$this->results = array();
	}

	public function add(ValidationResult $result, $fieldName){
		//the set is valid if all results are valid
		$this->isValid = ($this->isValid && $result->isValid());

		//if the index DNE, set it, else add to it
		if(!isset($this->results[$fieldName]))
			$this->results[$fieldName] = $result;
		else
			$this->results[$fieldName]->add($result);
	}

	public function __toString(){
		return implode('<br>', $this->results);
	}

	public function isValid(){
		return $this->isValid;
	}

    public function get(){
    	return $this->results;
    }
}