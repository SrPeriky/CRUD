<?PHP
class User_model extends Database{
	function getUserActive($email, $password){
        try {
        	$this->connect();
            $sql = "SELECT id FROM user WHERE email = '$email' AND clave = '$password' AND activo = 1";   
            $result = $this->getDataSingle($sql);
            $this->close();
            return $result;
        } catch (\Throwable $th) { }
    }

    public function saveUser($nom, $emal, $clave)
    {
    	try {
        	$this->connect();
            $l = $this->insert('user', array(
            	'clave' => $clave,
            	'email' => $emal,
            	'nom' => $nom,
            	'activo' => true
            )); $id = $this->getLastId();
            $this->close();
            return ($l) ? $id : false;
        } catch (\Throwable $th) { }
    }
}

?> 