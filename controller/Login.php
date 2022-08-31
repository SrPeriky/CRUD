<?php
class Login extends App{
	private $Sesion, $User_model;

    public function __CONSTRUCT(){
    	$this->Sesion = new Sesion();
    	$this->User_model = $this->model('User_model');
    }

    public function index(){   
    	if (!$this->Sesion->isConnected()) {
    		$this->view('head');
    		$this->view('login');
    		$this->view('foot');
    	} else $this->Sesion->redirectTo('home');
    }

    public function checkUser()
    {
        # code...
    }
}
 ?>