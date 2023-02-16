<?php
/**
 * Este es el archivo principal de la aplicación, donde se incluyen los archivos de configuración, base de datos y la clase App. 
 * También se define un FrontController que recibe el nombre del controlador y la acción a ejecutar, 
 * y verifica si existe un archivo correspondiente en la carpeta controller, 
 * si es así, crea una instancia del controlador y ejecuta el método de acción correspondiente. 
 * Si no existe el archivo o el método, muestra un mensaje de error 404.
 * Además, se inicia una sesión con session_start()
 * 
 * Inicia la sesión y ejecuta el controlador y acción correspondiente
 * Este archivo es el FrontController de la aplicación y se encarga de manejar
 * todas las solicitudes a la aplicación. Inicia la sesión, determina qué controlador
 * y acción se deben ejecutar en función de los parámetros recibidos y los archivos existentes,
 * y ejecuta la acción correspondiente si es posible.
 * @uses DEFAULT_CONTROLLER Define el nombre del controlador por defecto
 * @uses DEFAULT_ACTION Define el nombre de la acción por defecto
 * @uses MSG_ERROR_404 Define el mensaje de error 404
 */
@session_start();
require_once('./app/config.php');
require_once('./app/database.php');
require_once('./app/app.php');

// Todo esta lógica hara el papel de un FrontController
$controller = isset($_GET['c']) ? strtolower($_GET['c']) : DEFAULT_CONTROLLER;
$action = isset($_GET['a']) && $_GET['a'] != '' ? $_GET['a'] : DEFAULT_ACTION;

// echo $controller . "<br>" . $action;

define('CONTROLLER', $controller);

if (file_exists("controller/" . $controller . ".php")) {
	$controller = ucwords($controller);
	require_once "./controller/" . $controller . ".php";
	$controller = new $controller;
	if (method_exists($controller, strtolower($action))) {
		call_user_func(array($controller, $action));
	} else {
		echo MSG_ERROR_404;
	}
} else {
	echo MSG_ERROR_404;
}
?>