<?php
class Task extends App {
	private $Sesion, $Task_model, $StandardizeData;

    public function __CONSTRUCT()
    {
    	$this->Task_model = $this->model('Task_model');
        $this->StandardizeData = $this->library('StandardizeData');
        $this->Sesion = $this->library('sesion');
    }

    public function index()
    {
    	if ($this->Sesion->isConnected()) {
    		$this->view('head');
    		$this->view('nav');
            $tasks = $this->Task_model->getTasks();
    		$this->view('tasks', $tasks);
    		$this->view('foot');
    	} else $this->redirectTo();
		
    } 

    public function newTask()
    {
        if ($this->Sesion->isConnected()) {
            $_POST['titulo'] = $this->StandardizeData->removeBlankSpaces($_POST['titulo']);
            $_POST['detalle'] = $this->StandardizeData->removeBlankSpaces($_POST['detalle']);
            $id = $this->Task_model->newTask($_SESSION['ID'], $_POST['titulo'], $_POST['detalle']);
            $task = $this->Task_model->getTask($id);
            if($task) echo json_encode(array(
                'id' => $task['id'], 
                'titulo' => $task['titulo'], 
                'detalle' => $task['detalle'], 
                'fecha' => $task['fecha'], 
                'activo' => $task['activo'], 
            )); else echo json_encode(false);
        } else echo json_encode(false);
    }

    public function setTask()
    {
        if ($this->Sesion->isConnected()) {
            $_POST['titulo'] = $this->StandardizeData->removeBlankSpaces($_POST['titulo']);
            $_POST['detalle'] = $this->StandardizeData->removeBlankSpaces($_POST['detalle']);
            $task = $this->Task_model->setTask($_POST['id'], $_POST['titulo'], $_POST['detalle'], $_POST['activo']);
            echo json_encode($task);
        } else echo json_encode(false);
    }

    public function removeTask()
    {
       if ($this->Sesion->isConnected()) {
            $task = $this->Task_model->removeTask($_POST['id']);
            echo json_encode($task);
        } else echo json_encode(false);
    }
}
 ?>