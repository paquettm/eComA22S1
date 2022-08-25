<?php
namespace app\core;

/*Routing all requests to the appropriate controller method
e.g.
localhost/person/add -> run the add method in the personController class

localhost/person/delete -> run the delete method in the personController class

*/

class App{
	public function __construct(){
		echo $_GET['url'];
		//place the routing algorithm here
	}
}