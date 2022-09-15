<?php
namespace app\controllers;

class Vet extends \app\core\Controller{
	

	public function index(){
		//display a list of all the owners
		//instantiate an owner model object
		$owner = new \app\models\Owner();
		//call the ->getAll() method to get all owners from the DB
		$owners = $owner->getAll();
		//pass the collection of owners to the view
		print_r($owners);
	}

	public function add(){
		if(isset($_POST['action'])){//if the form is submitted
			//new object
			$newOwner = new \app\models\Owner();
			//populate the data from the input
			$newOwner->first_name = $_POST['first_name'];
			$newOwner->last_name = $_POST['last_name'];
			$newOwner->contact = $_POST['contact'];
			//call insert
			$newOwner->insert();
			header('location:/Vet');
		}else{
			$this->view('Vet/addOwner');
		}
	}

}