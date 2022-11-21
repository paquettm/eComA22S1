<?php
namespace app\models;

class Country extends \app\core\Model{

	public function getAll(){
		$SQL = "SELECT * FROM country";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Country');
		return $STMT->fetchAll();
	}
	
}
