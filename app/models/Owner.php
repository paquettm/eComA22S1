<?php
namespace app\models;

class Owner extends \app\core\Model{
	//needs to connect to the DB - through the Model base class

	public function getAll(){
		//get all records from the owner table
		$SQL = "SELECT * FROM owner";
		$STMT = $this->_connection->prepare($SQL);
		$STMT->execute();// pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Owner");
		return $STMT->fetchAll();
	}

	public function insert(){
		$SQL = "INSERT INTO owner(first_name, last_name, contact) VALUES (:first_name, :last_name, :contact)";
		$STMT = $this->_connection->prepare($SQL);
		$STMT->execute(['first_name'=>$this->first_name, 'last_name'=>$this->last_name, 'contact'=>$this->contact]);// pass any data for the query
	}

}