<?php
namespace app\core;

class Controller{
//TODO: add a parameter for data later
	public function view($name, $data = []){
		include('app/views/' . $name . '.php');
	}

}
