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
}