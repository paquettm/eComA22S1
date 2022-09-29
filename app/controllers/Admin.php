<?php
	namespace app\controllers;

	#[\app\filters\Login]
	#[\app\filters\Admin]
	class Admin{

		public function index(){
			echo "hello admin";
		}

	}