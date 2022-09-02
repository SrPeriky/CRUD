<?php
class User extends App{
	private $Sesion, $User_model, $Validate;

    public function __CONSTRUCT(){
    	$this->Sesion = $this->library('sesion');
        $this->Validate = $this->library('Validate');
    	$this->User_model = $this->model('User_model');
    }

    public function index(){   
    	if (!$this->Sesion->isConnected()){
            $this->view('head');
            $this->view('login');
            $this->view('foot');
        } else $this->Sesion->redirectTo('Task');;
    }

    public function checkUser()
    {
        if (!$this->Sesion->isConnected()) {
            $_POST['email'] = $this->Validate->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->Validate->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);
            $user = $this->User_model->getUserActive($_POST['email'], $_POST['password']);
            if ($user) {
               if(!$this->Sesion->new($user["id"])) echo json_encode("Error al crear la session");
               else echo json_encode(true);
            } else echo json_encode("Usuario incorrecto");
        } else echo json_encode("Ya existe una session");
    }

    public function checkIn()
    {
       if (!$this->Sesion->isConnected()) {
            $_POST['name'] = $this->Validate->removeBlankSpaces($_POST['name']);
            $_POST['email'] = $this->Validate->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->Validate->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);
            $id_user = $this->User_model->saveUser($_POST['name'], $_POST['email'], $_POST['password']);
            if ($id_user) {
               if(!$this->Sesion->new($id_user)) echo json_encode("Error al crear la session");
               else echo json_encode(true);
            } else echo json_encode("Usuario incorrecto");
       } else $this->Sesion->redirectTo('Task');
    }

    public function Logout()
    {
        if ($this->Sesion->isConnected()) {
            $this->Sesion->logout();
        } $this->Sesion->redirectTo('user', null, true);
    }
}
 ?>