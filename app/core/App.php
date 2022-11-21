<?php
namespace app\core;

class App{
	private $controller = 'Main';
	private $method = 'index';

	//filter and package the request
	public function getRequest(){
		$request = ['get'=>[], 'post'=>[]];
		foreach($_GET as $key=>$value){
			$request['get'][$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
		}
		$post = [];
		foreach ($_POST as $key => $value) {
			$request['post'][$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
		}
		return $request;
	}

	public function __construct(){
		//echo $_GET['url'];
		//TODO: replace this echo with the routing algorithm
		//goal: separate the url in parts

		$url = self::parseUrl(); //get the url parsed and returned as an array of URL segment
		
		//use the first part to determine the controller class to load

		if(isset($url[0])){
			if(file_exists('app/controllers/' . $url[0] . '.php')){
				$this->controller = $url[0]; //$this refers to the current object
			}
			unset($url[0]);
		}
		$this->controller = 'app\\controllers\\' . $this->controller; //provide a fully qualified classname
		$this->controller = new $this->controller;

		//use the second part to determine the method to run

		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
			}
			unset($url[1]);
		}

		//access filtering here to prevent running code requiring privilege
		//object to read the class properties
		$reflection = new \ReflectionObject($this->controller);
		//get the attributes
		$classAttributes = $reflection->getAttributes();//returns the attributes applied on the class
		$methodAttributes = $reflection->getMethod($this->method)->getAttributes(); //return the attributes applied on the specific method

		//merge the arrays
		$attributes = array_values(array_merge($classAttributes,$methodAttributes));

		foreach($attributes as $attribute){
			$filter = $attribute->newInstance();//make a new object of that filter class
			if($filter->execute()){
				return;//cut the execution if the user does not belong there
			}
		}

		//...while passing all other parts as arguments
		//repackage the parameters
		$params = $url ? array_values($url) : [];
		call_user_func_array([ $this->controller, $this->method ], $params);
	}

	public static function parseUrl(){
		if(isset($_GET['url']))//get url exists
		{
			return explode('/', //return parts in an array, separated by /
				filter_var(	//remove non-URL characters and sequences
					rtrim($_GET['url'], '/'))
				,FILTER_SANITIZE_URL);
		}
	}


}