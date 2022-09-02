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

   public function getTask($id)
   {
   	 try {
   	 	$this->connect();
   	 	$sql = "SELECT * FROM task WHERE id = $id;";
   	 	$result = $this->getDataSingle($sql);
   	 	$this->close();
   	 	return $result;
   	 } catch (\Throwable $th) { }
   }

   function newTask($id_user, $titulo, $detalle){
   	try {
   		$this->connect();
   		$l = $this->insert('task', array(
   			'id_user' => $id_user,
   			'titulo' => $titulo,
            'detalle' => $detalle,
           	'fecha' => date('j/m/Y'),
           	'activo' => true
        )); $id = $this->getLastId();
        $this->close();
        return ($l) ? $id : false;
   	} catch (\Throwable $th) { }
   }
   function setTask($id, $titulo, $detalle, $activo){
   	try {
   		$this->connect();
   		$sql = "UPDATE task SET titulo = '$titulo', detalle = '$detalle', activo = '$activo' WHERE task.id = $id AND task.id_user = ".$_SESSION['ID'];
   		$result = $this->executeInstruction($sql);
   		$this->close();
   		return $result;
   	} catch (\Throwable $th) { }
   	
   }
   function removeTask($id){
   	try {
   		$this->connect();
   		$sql = "DELETE FROM task WHERE task.id = $id";
   		$result = $this->executeInstruction($sql);
   		$this->close();
   		return $result;
   	} catch (\Throwable $th) { }
   }
}

?> 