<?php
namespace app\models;

class Animal extends \app\core\Model{
	public function getAll($owner_id){
		$SQL = "SELECT * FROM animal WHERE owner_id = :owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$owner_id]);//this is where we would pass the data
		//run some code to return the results
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Animal');
		return $STMT->fetchAll();
	}

	public function get($animal_id){
		$SQL = "SELECT * FROM animal WHERE animal_id=:animal_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$animal_id]);
		//run some code to return the results
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Animal');
		return $STMT->fetch();
	}

	public function insert(){
		$SQL = "INSERT INTO animal(owner_id, name, dob, profile_pic) VALUES (:owner_id, :name, :dob, :profile_pic)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$this->owner_id,
						'name'=>$this->name,
						'dob'=>$this->dob,
						'profile_pic'=>$this->profile_pic]);
	}

	public function update(){
		$SQL = "UPDATE animal SET name=:name, dob=:dob WHERE animal_id=:animal_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name'=>$this->name,
						'dob'=>$this->dob,
						'animal_id'=>$this->animal_id]);
	}

	public function delete(){
		$SQL = "DELETE FROM animal WHERE animal_id=:animal_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$this->animal_id]);
	}

	
}