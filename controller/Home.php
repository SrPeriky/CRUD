<?php
class Home extends App {
	private $Sesion, $Task_model;

    public function __CONSTRUCT()
    {
    	$this->Task_model = $this->model('Task_model');
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
    	} else $this->Sesion->redirectTo();
		
    } 
}
 ?>