<?php
namespace app\models;

class Owner extends \app\core\Model{
	#[\app\validators\Name]
	public $first_name;
	#[\app\validators\Name]
	public $last_name;
	#[\app\validators\Email]
	public $contact;
	
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

	public function get($owner_id){
		$SQL = "SELECT * FROM owner WHERE owner_id=:owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$owner_id]);
		//run some code to return the results
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Owner');
		return $STMT->fetch();
	}

	protected function insert(){
		$SQL = "INSERT INTO owner(first_name, last_name, contact) VALUES (:first_name, :last_name, :contact)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['first_name'=>$this->first_name,
						'last_name'=>$this->last_name,
						'contact'=>$this->contact]);
	}

	protected function update(){
		$SQL = "UPDATE owner SET first_name=:first_name, last_name=:last_name, contact=:contact WHERE owner_id=:owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['first_name'=>$this->first_name,
						'last_name'=>$this->last_name,
						'contact'=>$this->contact,
						'owner_id'=>$this->owner_id]);
	}

	public function delete(){
		$SQL = "DELETE FROM owner WHERE owner_id=:owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$this->owner_id]);
	}

	public function deleteAnimals(){
		$SQL = "DELETE FROM animal WHERE owner_id=:owner_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['owner_id'=>$this->owner_id]);
	}


	
}
