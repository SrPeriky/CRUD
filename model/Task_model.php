<?PHP
/**
 * La clase Task_model se encarga de realizar operaciones en la base de datos para las tareas.
 */
class Task_model extends Database
{
	/**
	 * Obtiene todas las tareas pertenecientes al usuario actual.
	 *
	 * @return array|bool Retorna un array con las tareas del usuario actual o false si hay un error.
	 */
	public function getTasks()
	{
		try {
			$this->connect();
			$sql = "SELECT * FROM task WHERE id_user = " . $_SESSION['ID'];
			$result = $this->getData($sql);
			$this->close();
			return $result;
		} catch (\Throwable $th) {
		}
	}

	/**
	 * Obtiene una tarea específica
     *
     * @param int $id El id de la tarea a obtener
     * @return array|bool Retorna un arreglo con los datos de la tarea o false si ocurre un error
	 */
	public function getTask($id)
	{
		try {
			$this->connect();
			$sql = "SELECT * FROM task WHERE id = $id;";
			$result = $this->getDataSingle($sql);
			$this->close();
			return $result;
		} catch (\Throwable $th) {
		}
	}

	/**
	 * Agrega una nueva tarea
     *
     * @param int $id_user El id del usuario al que se le asigna la tarea
     * @param string $titulo El título de la tarea
     * @param string $detalle Los detalles de la tarea
     * @return int|bool Retorna el id de la tarea creada o false si ocurre un error
	 */
	function newTask($id_user, $titulo, $detalle)
	{
		try {
			$this->connect();
			$l = $this->insert('task', array(
				'id_user' => $id_user,
				'titulo' => $titulo,
				'detalle' => $detalle,
				'fecha' => date('j/m/Y'),
				'activo' => true
			)
			);
			$id = $this->getLastId();
			$this->close();
			return ($l) ? $id : false;
		} catch (\Throwable $th) {
		}
	}

	/**
	 * Actualiza los datos de una tarea
     *
     * @param int $id El id de la tarea a actualizar
     * @param string $titulo El nuevo título de la tarea
     * @param string $detalle Los nuevos detalles de la tarea
     * @param bool $activo Si la tarea está activa o no
     * @return bool Retorna true si la tarea fue actualizada correctamente o false si ocurre un error
	 */
	function setTask($id, $titulo, $detalle, $activo)
	{
		try {
			$this->connect();
			$sql = "UPDATE task SET titulo = '$titulo', detalle = '$detalle', activo = '$activo' WHERE task.id = $id AND task.id_user = " . $_SESSION['ID'];
			$result = $this->executeInstruction($sql);
			$this->close();
			return $result;
		} catch (\Throwable $th) {
		}

	}
	
	/**
	 * Elimina una tarea
     *
     * @param int $id El id de la tarea a eliminar
     * @return bool Retorna true si la tarea fue eliminada correctamente o false si ocurre un error
	 */
	function removeTask($id)
	{
		try {
			$this->connect();
			$sql = "DELETE FROM task WHERE task.id = $id";
			$result = $this->executeInstruction($sql);
			$this->close();
			return $result;
		} catch (\Throwable $th) {
		}
	}
}
?>