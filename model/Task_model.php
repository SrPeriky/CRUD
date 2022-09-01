<?PHP
class Task_model extends Database{
   public function getTasks()
   {
   	try {
   		$this->connect();
   		$sql = "SELECT * FROM task WHERE id_user = ".$_SESSION['ID'];
   		$result = $this->getData($sql);
   		$this->close();
   		return $result;
   	} catch (\Throwable $th) { }
   }
}

?> 