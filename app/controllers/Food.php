<?php
namespace app\controllers;

class Food extends \app\core\Controller{

	public function index(){
		//process the form data if it is submitted
		if(isset($_POST['action'])){
			//create a Food object
			$newfood = new \app\models\Food();
			//populate the Food object
			$newfood->name = $_POST['new_food'];
			//call insert
			$newfood->insert();
		}

		//read the foods.txt file into a variable
		$food = new \app\models\Food();
		$foods = $food->getAll();
		
		//pass the foods to the view for render and output
		$this->view('Food/index', $foods);
	}

	public function delete($food_id){//delete a food item here
		//I would like to delete the record with a specific id
		$food = new \app\models\Food();
		$food->deleteAt($food_id);
		//redirect to the list
		header('location:/Food');
	}

	public function outputJSON(){
		//service that outputs JSON
		//read the foods.txt file into a variable
		$food = new \app\models\Food();
		$foods = $food->getAll();
		
		echo json_encode($foods);
	}

	public function display(){
		$this->view('Food/display');
	}
}