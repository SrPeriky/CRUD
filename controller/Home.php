<?php
class Home extends App {
	private $Sesion, $Task_model;

    public function __CONSTRUCT()
    {
    	$this->Task_model = $this->model('Task_model');
    	$this->Sesion = new Sesion();
    }

    public function index()
    {
    	if ($this->Sesion->isConnected()) {
    		$this->model('head');
    		$this->model('nav');
    		$this->model('tasks');
    		$this->model('foot');
    	} else $this->Sesion->redirectTo();
		
    } 
}
 ?>