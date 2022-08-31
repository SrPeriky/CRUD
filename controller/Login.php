<?php
class Login extends App{
	private $Sesion, $User_model, $Validate;

    public function __CONSTRUCT(){
    	$this->Sesion = $this->library('sesion');
        $this->Validate = $this->library('Validate');
    	$this->User_model = $this->model('User_model');
    }

    public function index(){   
    	if (!$this->Sesion->isConnected()) {
            $l = $this->User_model->save('nom', 'emal', 'password');
            var_dump($l);
    		$this->view('head');
    		$this->view('login');
    		$this->view('foot');
    	} else $this->Sesion->redirectTo('home');
    }

    public function checkUser()
    {
        if (!$this->Sesion->isConnected()) {
            $_POST['email'] = $this->validacion->removeBlankSpaces($_POST['cuenta']);
            $_POST['password'] = $this->validacion->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);
            $user = $this->User_model->logIn($_POST['email'], $_POST['password']);

            if ($user) {
                $this->Sesion->new($id_user);
            }
            
        } else return false;
    }
}
 ?>