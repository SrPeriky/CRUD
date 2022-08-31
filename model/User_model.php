<?PHP
class User_model extends Database{
	function logIn($email, $password){
        try {
            $sql = "SELECT * FROM user WHERE email = '$email' AND clave = '$password' AND activo = 1";   
            $result = $this->query($sql);
            //$result = $this->row($result)
            return $result;
        } catch (\Throwable $th) { }
    }

    public function save($nom, $emal, $password)
    {
    	try {
            $sql = "INSERT INTO user (nom, email, clave) VALUES ('$nom', '$emal', '$password'); ";   
            $result = $this->query($sql);
            $result = mysqli_affected_rows($result);
            return $result;
        } catch (\Throwable $th) { }
    }
}

?> 