<?php
namespace app\models;

//self:: refers to the class
//$this-> refers to the object

class Food{
	public $name;
	public $id;//line number in the file
	private static $file = 'app/resources/foods.txt';

	public function insert(){
		//add the new entry to the end of the file
		$fh = fopen(self::$file, 'a');
		flock($fh, LOCK_EX);
		fwrite($fh, $this->name . "\n");
		flock($fh, LOCK_UN);
		fclose($fh);
	}

	public function getAll(){//return all the Food items from the file
		$foods = file(self::$file);
		$output = [];//or array() to build an empty array
		$i = 0;
		foreach ($foods as $food) {
			$item = new Food();
			$item->name = $food;
			$item->id = $i;
			$output[] = $item;
			$i++;
		}
		return $output;
	}

	public function deleteAt($food_id){
		$foods = file(self::$file);//read the file
		if(!isset($foods[$food_id]))
			return;
		unset($foods[$food_id]);

		//open the file for writing
		$fh = fopen(self::$file, 'w');
		flock($fh,LOCK_EX);
		foreach ($foods as $food) {
			fwrite($fh, $food);
		}
		flock($fh,LOCK_UN);
		fclose($fh);
	}

	public function __toString(){
		return $this->name;
	}

}