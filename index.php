<?php
	// include();//try to import a file and warn us on failure
	// include_once();//try to import a file (if it was not previously imported) and warn us on failure
	// require();//try to import a file and halt on failure
	// require_once();//try to import a file (if it was not previously imported) and halt on failure
	require_once('app/core/init.php');

	new \app\core\App();