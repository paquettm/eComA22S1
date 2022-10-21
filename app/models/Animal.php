<?php
namespace app\models;

class Animal extends \app\core\Model{

	public $animal_id;
	#[\app\validators\NonEmpty]	//attribute
	#[\app\validators\Name]	//attribute
	public $name;			//property
	#[\app\validators\ValidBirthDateForAnAnimal]
	public $dob;
	public $profile_pic;
	public $owner_id;

	public function getForOwner($owner_id){
		$SQL = "SELECT * FROM animal WHERE owner_id=:owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$owner_id]);//this is where we would pass the data
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
		if(!$this->isValid()) return false;
		$SQL = "INSERT INTO animal(owner_id, name, dob, profile_pic) VALUES (:owner_id, :name, :dob ,:profile_pic)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$this->owner_id,
						'name'=>$this->name,
						'dob'=>$this->dob,
						'profile_pic'=>$this->profile_pic]);
	}

	public function update(){
		if(!$this->isValid()) return false;		
		$SQL = "UPDATE animal SET name=:name, dob=:dob, profile_pic=:profile_pic WHERE animal_id=:animal_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name'=>$this->name,
						'dob'=>$this->dob,
						'profile_pic'=>$this->profile_pic,
						'animal_id'=>$this->animal_id]);
	}

	public function delete(){
		$SQL = "DELETE FROM animal WHERE animal_id=:animal_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$this->animal_id]);
	}

}