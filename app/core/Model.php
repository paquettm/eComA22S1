<?php
namespace app\core;

class Model{
	protected static $_connection;
	public static $validation = null;
	public static $input = null;

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

	protected function validate($method){//aplication of all validators on the object properties
		self::$input = $this;
		self::$validation = new ValidationResultSet();
		$reflection = new \ReflectionObject($this);
		//find the properties
		$classProperties = $reflection->getProperties();
		foreach ($classProperties as $property) {
			$propertyAttributes = $property->getAttributes();
			foreach ($propertyAttributes as $attribute) {
				$arguments = $attribute->getArguments();
				if(count($arguments) == 0 || in_array($method, $arguments)){//only test if the method to run is in the validation list or there is no validation list
					$test = $attribute->newInstance();
					self::$validation->add($test->isValidData(
						$property->getValue($this)), 
						$property->name
					);
				}
			}
		}
		return self::$validation;
	}
	
	public function __call($method, $arguments){
		//called from the object receiving the bad call
		$resultSet = $this->validate($method);
		if($resultSet->isValid())
			call_user_func_array([$this, $method], $arguments);
		return $resultSet;
	}
}