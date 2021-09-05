<?php
	session_start();

	require_once 'app/core/Core.php';
	require_once 'lib/Database/Connection.php';
	require_once 'app/controller/LoginController.php';	 
    require_once 'app/controller/AdminController.php';  
	require_once 'app/model/Usuario.php';
	require_once 'app/vendor/autoload.php';
       

	$core = new Core;
	echo $core->start($_GET);