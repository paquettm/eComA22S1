<?php
namespace app\controllers;

class Animal extends \app\core\Controller{

	public function index($owner_id){//list of records in context for an owner
		//GET DATA FROM THE DB
		$animal = new \app\models\Animal();
		$animals = $animal->getForOwner($owner_id);
		$owner= new \app\models\Owner();
		$owner = $owner->get($owner_id);
		//call the view
		$this->view('Animal/index',['animals'=>$animals,'owner'=>$owner]);
	}

	public function details($animal_id){//detailed view for a record
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		$owner_id = $animal->owner_id;
		$owner = new \app\models\Owner();
		$owner = $owner->get($owner_id);
		$this->view('Animal/details', ['animal'=>$animal, 'owner'=>$owner]);
		//this is the corrected example, a / was missing in front
		//echo '<img src="/images/' . $animal->profile_pic . '">';
	}

	public function add($owner_id){//add a new record
		if(isset($_POST['action'])){
			//make a new object
			$animal = new \app\models\Animal();
			//populate the object
			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];
			$animal->owner_id = $owner_id;//FK from the parameters
			$animal->country_id = $_POST['country_id'];//FK from the parameters
			//TODO:
			$filename = $this->saveFile($_FILES['profile_pic']);
			$animal->profile_pic = $filename;
			//call insert on the object
			$animal->insert();
			header('location:/Animal/index/' . $owner_id);
		}else{
			$owner = new \app\models\Owner();
			$owner = $owner->get($owner_id);
			$country = new \app\models\Country();
			$countries= $country->getAll();

			$this->view('Animal/add',['owner'=>$owner,'countries'=>$countries]);
		}
	}

	public function delete($animal_id){//remove a record
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		$owner_id = $animal->owner_id;
		unlink("images/$animal->profile_pic");
		$animal->delete();
		header('location:/Animal/index/' . $owner_id);
	}

	public function edit($animal_id){//modify a record
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		$owner_id = $animal->owner_id;
		if(isset($_POST['action'])){
			$filename = $this->saveFile($_FILES['profile_pic']);
			if($filename){
				//delete the old picture
				unlink("images/$animal->profile_pic");
				//save the reference to the new one
				$animal->profile_pic = $filename;
			}
			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];
			$animal->country_id = $_POST['country_id'];
			$animal->update();
			//redirect
			header('location:/Animal/index/' . $owner_id);
		}else{
			$owner = new \app\models\Owner();
			$owner = $owner->get($owner_id);
			$country = new \app\models\Country();
			$countries= $country->getAll();
			$this->view('Animal/edit',['owner'=>$owner,'animal'=>$animal,'countries'=>$countries]);
		}
	}



}