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
		$owner = new \app\models\Owner();
		$owner = $owner->get($owner_id);
		$country = new \app\models\Country();
		$countries= $country->getAll();		

		if(isset($_POST['action'])){
			$animal = new \app\models\Animal();

			$filename = $this->saveFile($_FILES['profile_pic']);

			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];
			$animal->owner_id = $owner_id;
			$animal->profile_pic = $filename;
			$animal->country_id = $_POST['country_id'];

			if($filename){
				if(isset($_SESSION['profile_pic']))
					unlink("images/$_SESSION[profile_pic]");
				//delete the old picture and then change the picture
				$_SESSION['profile_pic'] = $filename;
			}
			if(isset($_SESSION['profile_pic']))
				$animal->profile_pic = $_SESSION['profile_pic'];

			if($animal->insert()->isValid()){
				unset($_SESSION['profile_pic']);
				header('location:/Animal/index/' . $owner_id);
			}else{
				$this->view('Animal/add',['owner'=>$owner,'countries'=>$countries]);
			}
		}else{
			$this->view('Animal/add',['owner'=>$owner,'countries'=>$countries]);
		}
	}

	public function edit($animal_id){
		$animal = new \app\models\Animal();
		$animal = $animal->get($animal_id);
		\app\core\Model::$input = $animal;
		$owner_id = $animal->owner_id;
		$owner = new \app\models\Owner();
		$owner = $owner->get($owner_id);
		if(isset($_POST['action'])){

			$filename = $this->saveFile($_FILES['profile_pic']);

			if($filename){
				//delete the old picture ONLY IF VALID
				//unlink for recorded filename moved after update
				if(isset($_SESSION['filename']))//changing
					unlink("images/$_SESSION[filename]");
				$_SESSION['filename'] = $filename;

				$_SESSION['oldFile'] = $animal->profile_pic;
				$animal->profile_pic = $filename;
			}elseif(isset($_SESSION['filename'])){
				$animal->profile_pic = $_SESSION['filename'];
			}
			$animal->name = $_POST['name'];
			$animal->dob = $_POST['dob'];
			$animal->country_id = $_POST['country_id'];

			//if the update operation is valid
			if($animal->update()->isValid()){
				if(isset($_SESSION['oldFile']))
					unlink("images/$_SESSION[oldFile]");
				unset($_SESSION['oldFile']);
				unset($_SESSION['filename']);
				header('location:/Animal/index/' . $owner_id);
			}else{
				$this->view('Animal/edit',['owner'=>$owner]);
			}
		}else{
			$owner = new \app\models\Owner();
			$owner = $owner->get($owner_id);
			$country = new \app\models\Country();
			$countries= $country->getAll();

			$this->view('Animal/edit',['owner'=>$owner, 'animal'=>$animal,'countries'=>$countries]);
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
