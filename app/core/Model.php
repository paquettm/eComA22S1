<?php
namespace app\core;

class Model{
	protected static $_connection;

	public function __construct(){
		$server = 'localhost';//127.0.0.1
		$dbname = 'vet_clinic';
		$username = 'root';
		$password = '';

		try{
			self::$_connection = new \PDO("mysql:host=$server;dbname=$dbname",
											$username,$password);
			self::$_connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		}catch(\Exception $e){
			echo "Failed connecting to the database";
			exit(0);
		}
	}

	function isValid(){//aplication of all validators on the object properties
		$results = new ValidationResultSet();
		$reflection = new \ReflectionObject($this);
		//find the properties
		$classProperties = $reflection->getProperties();
		foreach ($classProperties as $property) {
			$propertyAttributes = $property->getAttributes();
			foreach ($propertyAttributes as $attribute) {
				$test = $attribute->newInstance();
				$results->add($test->isValidData($property->getValue($this)), $property->name);
			}
		}
		return $results;
	}
	
	public function __call($method, $arguments){
		//called from the object receiving the bad call
		$resultSet = $this->isValid();
		if($resultSet->isValid)
			call_user_func_array([$this, $method], $arguments);
		return $resultSet;
	}
}
