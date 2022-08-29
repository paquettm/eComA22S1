<?php
	// include() try to include and warn on failure
	// include_once() try to include (if not previously included) and warn on failure
	// require() try to include and halt on failure
	// require_once() try to include (if not previously included) and halt on failure
	require("app/core/init.php");
	new app\core\App();
