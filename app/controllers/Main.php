<?php
namespace app\controllers;

class Main extends \app\core\Controller{
	public function index(){
		$this->view('Main/index');
	}

	function test(){
		phpinfo();
	}

	public function index2(){
		$this->view('Main/index2');
	}

	public function foods(){

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
		$this->view('Main/foods', $foods);
	}


	public function foodsJSON(){
		//service that outputs JSON
		//read the foods.txt file into a variable
		$food = new \app\models\Food();
		$foods = $food->getAll();
		
		echo json_encode($foods);
	}

	public function foodsAJAX(){
		$this->view('Main/foodsAJAX');
	}


}