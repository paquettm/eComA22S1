<?php
namespace app\models;

class User extends \app\core\Model{
	#[\app\validators\UniqueUser('insert')]
	public $username;
	#[\app\validators\ConfirmValue]
	public $password;

	public function get($username){
		$SQL = "SELECT * FROM user WHERE username LIKE :username";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		//run some code to return the results
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\User');
		return $STMT->fetch();
	}

	protected function insert(){
		$SQL = "INSERT INTO user(username, password_hash) VALUES (:username, :password_hash)";
		$STMT = self::$_connection->prepare($SQL);
		$password_hash = password_hash($this->password[0], PASSWORD_DEFAULT);
		$STMT->execute(['username'=>$this->username,
						'password_hash'=>$password_hash]);
	}

//fails if object is populated with current username because of UniqueUser constraint. This is a weird one.
	protected function updatePassword(){
		$SQL = "UPDATE user SET password_hash=:password_hash WHERE user_id=:user_id";
		$STMT = self::$_connection->prepare($SQL);
		$password_hash = password_hash($this->password[0], PASSWORD_DEFAULT);
		$STMT->execute(['password_hash'=>$password_hash,
						'user_id'=>$this->user_id]);
	}

/*
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
*/

	
}
