<?php
namespace app\controllers;

class Test extends \app\core\Controller{

	public function index(){

		echo $_SERVER['REMOTE_ADDR'];

		$url = "https://ipinfo.io/205.236.144.4/geo";
		
		$response = \app\core\ExternalData::get($url, 'GET');

		echo $response;

	}

	public function dog(){

		$url = "https://dog.ceo/api/breeds/image/random";
		
		$response = \app\core\ExternalData::get($url, 'GET');

		$this->view('Test/Image',json_decode($response));

	}

}