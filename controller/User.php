<?php
class User extends App{
	private $Sesion, $User_model, $Validate, $StandardizeData;

    public function __CONSTRUCT(){
    	$this->Sesion = $this->library('sesion');
        $this->Validate = $this->library('Validate');
        $this->StandardizeData = $this->library('StandardizeData');
    	$this->User_model = $this->model('User_model');
    }

    public function index(){   
    	if (!$this->Sesion->isConnected()){
            $this->view('head');
            $this->view('login');
            $this->view('foot');
        } else $this->redirectTo('Task');;
    }

    public function checkUser()
    {
        if (!$this->Sesion->isConnected()) {
            $_POST['email'] = $this->StandardizeData->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->StandardizeData->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);
            if (!$this->Validate->isEmail($_POST['email'])) {
                echo json_encode("Email incorrecto");
            } else {
                $user = $this->User_model->getUserActive($_POST['email'], $_POST['password']);
                if ($user) {
                   if(!$this->Sesion->new($user["id"])) echo json_encode("Error al crear la session");
                   else echo json_encode(true);
                } else echo json_encode("Usuario incorrecto");
            }
        } else echo json_encode("Ya existe una session");
    }

    public function checkIn()
    {
       if (!$this->Sesion->isConnected()) {
            $_POST['name'] = $this->StandardizeData->removeBlankSpaces($_POST['name']);
            $_POST['email'] = $this->StandardizeData->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->StandardizeData->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);
            if (!$this->Validate->isEmail($_POST['email'])) {
                echo json_encode("Email incorrecto");
            } else {
                $id_user = $this->User_model->saveUser($_POST['name'], $_POST['email'], $_POST['password']);
                if ($id_user) {
                   if(!$this->Sesion->new($id_user)) echo json_encode("Error al crear la session");
                   else echo json_encode(true);
                } else echo json_encode("Usuario incorrecto");
            }
       } else $this->redirectTo('Task');
    }

    public function Logout()
    {
        if ($this->Sesion->isConnected()) {
            $this->Sesion->logout();
        } $this->redirectTo('user', null, true);
    }
}
 ?>