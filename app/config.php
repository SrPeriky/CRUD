<?PHP
/**
 * Define constantes de configuración para la aplicación.
 * 
 * Las constantes establecen los valores de configuración para la base de datos,
 * la fecha actual, el controlador y la acción predeterminados, la URL base y los mensajes de error.
 * 
 * Además, establece la zona horaria predeterminada para el servidor.
 * 
 * @const string HOST_NAME El nombre del host de la base de datos.
 * @const string DB_NAME El nombre de la base de datos.
 * @const string US_NAME El nombre de usuario de la base de datos.
 * @const string PSSWORD La contraseña de la base de datos.
 * @const string HOY La fecha actual en formato Y-m-d.
 * @const string DEFAULT_CONTROLLER El controlador predeterminado para la aplicación.
 * @const string DEFAULT_ACTION La acción predeterminada para la aplicación.
 * @const string BASE_URL La URL base de la aplicación.
 * @const string MSG_ERROR_DB El mensaje de error para problemas de conexión con la base de datos.
 * @const string MSG_ERROR_404 El mensaje de error para rutas no encontradas.
 * @see date_default_timezone_set() Para establecer la zona horaria del servidor.
 */
define('HOST_NAME', 'localhost');
define('DB_NAME', 'prueba');
define('US_NAME', 'root');
define('PSSWORD', '');
define('_HOY_', date('Y-m-d'));
define('DEFAULT_CONTROLLER', 'user');
define('DEFAULT_ACTION', 'index');
define('BASE_URL', 'http://localhost/CRUD/');
define('MSG_ERROR_DB', 'Se produjo un error al conectar con la base de datos');
define('MSG_ERROR_404', 'Se produjo un error, no se ah encontrado la ruta');
date_default_timezone_set('America/Bogota');
?>