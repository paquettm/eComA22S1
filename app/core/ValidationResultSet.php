<?php
namespace app\core;

class ValidationResultSet implements \ArrayAccess{
	public $isValid;
	public $results;
	public function __construct(){
		$this->isValid = true;
		$this->results = array();
	}

	public function add(ValidationResult $result, $fieldName){
		$this->isValid = ($this->isValid && $result->isValid);

		if(!isset($this->results[$fieldName]))
			$this->results[$fieldName] = $result;
		else
			$this->results[$fieldName]->add($result);

	}

	public function __toString(){
		return implode('<br>', $this->results);
	}

	 public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->results[] = $value;
        } else {
            $this->results[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->results[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->results[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->results[$offset]) ? $this->results[$offset] : null;
    }
    public function getSet(){
    	return $this->results;
    }
}



   