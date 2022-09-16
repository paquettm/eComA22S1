<?php
namespace app\models;

class Owner extends \app\core\Model{
	public function getAll(){
		//return the collection of all owners
		//run "SELECT * FROM owner"
		$SQL = "SELECT * FROM owner";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();//this is where we would pass the data
		//run some code to return the results
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Owner');
		return $STMT->fetchAll();
	}

	public function insert(){
		$SQL = "INSERT INTO owner(first_name, last_name, contact) VALUES (:first_name, :last_name, :contact)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['first_name'=>$this->first_name,
						'last_name'=>$this->last_name,
						'contact'=>$this->contact]);
	}






}