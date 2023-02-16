<?php
/**
 * se encargan de manejar la sesión del usuario
 */
class Sesion
{
	/**
	 * Token de sesión para validar la conexión de un usuario.
	 * 
	 * @var string
	 */
	private $TOKEN;

	/**
	 * Verifica si el usuario está conectado y su sesión es válida.
	 * 
	 * @return bool Retorna true si el usuario está conectado y la sesión es válida, de lo contrario retorna false
	 */
	public function isConnected()
	{
		try {
			$this->TOKEN = @$_SESSION['TOKEN'];
			if (!isset($_SESSION[$this->TOKEN]))
				return false;
			if ($_SESSION[$this->TOKEN] != (MD5($_SESSION['ID'])))
				return false;
			if (!isset($_SESSION['expire']))
				return false;
			if (time() < $_SESSION['expire'])
				$_SESSION['expire'] = time() + (3600 * 60);
			else
				return false;
			return true;
		} catch (\Throwable $th) {
		}
	}

	/**
	 * Cierra la sesión actual del usuario
	 * 
	 * @return void
	 */
	public function logout()
	{
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(
				session_name(),
				'', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
	}

	/**
	 * Inicia una nueva sesión de usuario
	 * 
	 * @param int $id_user ID del usuario que inicia sesión
	 * @return bool Retorna true si la sesión es iniciada con éxito, de lo contrario retorna false
	 */
	public function new ($id_user)
	{
		if (!$this->isConnected()) {
			$_SESSION['time'] = time();
			$_SESSION['expire'] = $_SESSION['time'] + (3600 * 4600 * 5600 * 6600);
			$this->TOKEN = md5(date('Y-m-d H:i:s'));
			$_SESSION['ID'] = $id_user;
			$_SESSION['TOKEN'] = $this->TOKEN;
			$_SESSION[$this->TOKEN] = MD5($id_user);
			return true;
		}
		return false;
	}
}
?>