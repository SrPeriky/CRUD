<?php 
@session_start();
require_once('./app/config.php');
require_once('./app/database.php');

// Todo esta lógica hara el papel de un FrontController
$controller = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : DEFAULT_CONTROLLER;
$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : DEFAULT_ACTION;

if (file_exists("controller/" .$controller. ".php")) {
	require_once "./controller/" .$controller. ".php";
	$controller = ucwords($controller);
	$controller = new $controller;
	if(method_exists($controller, strtolower($accion))){
		call_user_func(array( $controller, $accion ));
	}
} else {
	echo MSG_ERROR_404;
}

 ?>