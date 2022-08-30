<?php 
class Conexion extends mysqli{
	public function __construct(){
        try {
        	parent::__construct(HOST_NAME, US_NAME, PSSWORD, DB_NAME);
        	$this->query("SET NAMES utf8;");
        	$this->connect_errno ? die(MSG_ERROR_DB) : null;
            //code...
        } catch (\Throwable $th) {
        	echo MSG_ERROR_DB;
        }
    }
    public function rows($x){
        return mysqli_num_rows($x);
    }
    public function recorrer($x){
        return mysqli_fetch_array($x);
    }
    public function liberar($x){
        return mysqli_free_result($x);
    }
}
?>