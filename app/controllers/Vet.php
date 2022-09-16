<?php
namespace app\controllers;

class Vet extends \app\core\Controller{
	public function index(){
		//display all the owners in the database
		//make an owner object
		$owner = new \app\models\Owner();
		//call getAll on that object to get the collection of all owners
		$owners = $owner->getAll();
		//call a view and pass the collection for display
		print_r($owners);
	}

	//to add a new owner in our database
	public function add(){
		//if I submit the form
		if(isset($_POST['action'])){
			//create a new owner object
			$newOwner = new \app\models\Owner();
			//populate the new owner objects
			$newOwner->first_name = $_POST['first_name'];
			$newOwner->last_name = $_POST['last_name'];
			$newOwner->contact = $_POST['contact'];
			//call insert on the new owner object
			$newOwner->insert();
			//redirect back to the list (index)
			header('location:/Vet/index');
		}
		else
			$this->view('Vet/addOwner');


	}

}