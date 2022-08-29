<?php
//this is 75% of a PSR-4 autoloader
spl_autoload_register(
	function ($class_name){
		require_once($class_name . ".php");
	}
);