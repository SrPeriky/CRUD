<?php 
class Sesion {
	private $TOKEN;
	public function isConnected()
	{
		try {
			$this->TOKEN = @$_SESSION['TOKEN'];
			if(!isset($_SESSION[$this->TOKEN])) return false;
		    if($_SESSION[$this->TOKEN] != (MD5($_SESSION['ID'].$_SESSION['NOM']))) return false;
		    if(!isset($_SESSION['expire'])) return false;
		    if(time() < $_SESSION['expire']) $_SESSION['expire'] = time() + (3600*60); else return false;
		    return true;
		} catch (\Throwable $th) { }
	}

	public function logout()
	{
		$_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        } session_destroy();
        return true;
	}

	public function new($id_user)
	{
		if (!$this->isConnected()) {
			$_SESSION['time'] = time();
            $_SESSION['expire'] = $_SESSION['time'] + (3600*4600*5600*6600);
            $this->TOKEN = md5(date('Y-m-d H:i:s'));
            $_SESSION['TOKEN'] = $TOKEN;
            $_SESSION[$TOKEN] = MD5($id_user);
            return true;
		} return false;
	}

	public function redirectTo($c = DEFAULT_CONTROLLER)
	{
		if(CONTROLLER != $c) header('Location: ./?c='.$c);
    }
}
?>