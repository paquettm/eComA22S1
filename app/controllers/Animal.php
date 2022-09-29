<?php
namespace app\controllers;

class Animal extends \app\core\Controller{
	
	//list the animals owned by a specific owner
	public function index($owner_id){
		$owner = new \app\models\Owner();
		$owner = $owner->get($owner_id);
		$animal = new \app\models\Animal();
		$animals = $animal->getAll($owner_id);
		$this->view('Animal/index',['owner'=>$owner, 'animals'=>$animals]);//TODO: build ths view
	}

	public function add($owner_id){
		if(isset($_POST['action'])){
			$animal = new \app\models\Animal();

			$filename = $this->saveFile($_FILES['profile_pic']);

			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];
			$animal->owner_id = $owner_id;
			$animal->profile_pic = $filename;

			$animal->insert();

			header('location:/Animal/index/' . $owner_id);
		}else{
			$owner = new \app\models\Owner();
			$owner = $owner->get($owner_id);
			$this->view('Animal/add',['owner'=>$owner]);
		}
	}

	public function edit($animal_id){
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		$owner_id = $animal->owner_id;

		if(isset($_POST['action'])){

			$filename = $this->saveFile($_FILES['profile_pic']);

			if($filename){
				//delete the old picture and then change the picture
				unlink("images/$animal->profile_pic");
				$animal->profile_pic = $filename;
			}
			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];

			$animal->update();

			header('location:/Animal/index/' . $owner_id);
		}else{
			$owner = new \app\models\Owner();
			$owner = $owner->get($owner_id);
			$this->view('Animal/edit',['owner'=>$owner, 'animal'=>$animal]);
		}
	}

	public function details($animal_id){
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		$owner = new \app\models\Owner();
		$owner = $owner->get($animal->owner_id);
		$this->view('Animal/details', ['animal'=>$animal, 'owner'=>$owner]);
	}

	public function delete($animal_id){
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);

		//delete the file
		unlink("images/$animal->profile_pic");

		$owner_id = $animal->owner_id;
		$animal->delete();
		header('location:/Animal/index/' . $owner_id);
	}
}