<?php
namespace app\models;

class Food{
	private static $file = 'app/resources/foods.txt';
	public $name;

	public function getAll(){
		//return all the food records
		$foods = file(self::$file);
		$output = [];
		foreach ($foods as $key => $value) {
			$newFood = new Food();
			//kinda like a primary key
			$newFood->id = $key;
			$newFood->name = $value;
			$output[] = $newFood;
		}
		return $output;
	}

	public function insert(){
		//insert a new food record
		$fh = fopen(self::$file, 'a');
		flock($fh, LOCK_EX);
		fwrite($fh, $this->name . "\n");
		flock($fh, LOCK_UN);
		fclose($fh);
	}

	public function deleteAt($index){
		$foods = file(self::$file);
		if(!isset($foods[$index])) 
			return;
		//delete element $line_num
		unset($foods[$index]);
		$foods = array_values($foods);
		//write everything back
		$fh = fopen(self::$file, 'w');
		flock($fh, LOCK_EX);
		foreach ($foods as $key => $value) {
			fwrite($fh, $value);
		}
		flock($fh, LOCK_UN);
		fclose($fh);
	}

	public function __toString(){
		return $this->name;
	}
}