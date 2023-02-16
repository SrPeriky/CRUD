<?php
/**
 * Clase User encargada de manejar las funciones de usuario.
 */
class User extends App
{
    /**
     * @var Sesion Variable privada que guarda la instancia de la clase Sesion.
     * @var User_model Variable privada que guarda la instancia de la clase User_model.
     * @var Validate Variable privada que guarda la instancia de la clase Validate.
     * @var StandardizeData Variable privada que guarda la instancia de la clase StandardizeData.
     */
    private $Sesion, $User_model, $Validate, $StandardizeData;

    /**
     * Constructor de la clase User, instancia los objetos Sesion, Validate, StandardizeData y User_model.
     */
    public function __CONSTRUCT()
    {
        $this->Sesion = $this->library('sesion');
        $this->Validate = $this->library('Validate');
        $this->StandardizeData = $this->library('StandardizeData');
        $this->User_model = $this->model('User_model');
    }

    /**
     * Función encargada de mostrar la vista de inicio de sesión.
     * 
     * @return void
     */
    public function index()
    {
        if (!$this->Sesion->isConnected()) {
            $this->view('head');
            $this->view('login');
            $this->view('foot');
        } else
            $this->redirectTo('Task');
    }

    /**
     * Función encargada de realizar el inicio de sesión del usuario.
     * 
     * @return void
     */
    public function userLogIn()
    {
        if (!$this->Sesion->isConnected()) {
            $_POST['email'] = $this->StandardizeData->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->StandardizeData->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);

            if (!$this->Validate->isEmail($_POST['email'])) {
                echo json_encode("Email incorrecto");
                return;
            }

            $user = $this->User_model->getUserActive($_POST['email'], $_POST['password']);

            if (!$user) {
                echo json_encode("Usuario incorrecto");
                return;
            }

            if (!$this->Sesion->new($user["id"])) {
                echo json_encode("Error al crear la session");
                return;
            }

            echo json_encode(true);

        } else
            echo json_encode("Ya existe una session");
    }

    /**
     * Función encargada de registrar un nuevo usuario.
     * 
     * @return void
     */
    public function registerUser()
    {
        if (!$this->Sesion->isConnected()) {
            $_POST['name'] = $this->StandardizeData->removeBlankSpaces($_POST['name']);
            $_POST['email'] = $this->StandardizeData->removeBlankSpaces($_POST['email']);
            $_POST['password'] = $this->StandardizeData->removeBlankSpaces($_POST['password']);
            $_POST['password'] = MD5($_POST['password']);

            if (!$this->Validate->isEmail($_POST['email'])) {
                return;
                echo json_encode("Email incorrecto");
            }

            $id_user = $this->User_model->saveUser($_POST['name'], $_POST['email'], $_POST['password']);

            if (!$id_user) {
                echo json_encode("Usuario no registrado");
                return;
            }

            if (!$this->Sesion->new($id_user)) {
                echo json_encode("Error al crear la session");
                return;
            }

            echo json_encode(true);

        } else
            $this->redirectTo('Task');
    }

    /**
     * Cierra la sesión del usuario actual.
     * Si no hay sesión abierta, redirige al usuario a la página de inicio de sesión.
     * 
     * @return void
     */
    public function Logout()
    {
        if ($this->Sesion->isConnected()) {
            $this->Sesion->logout();
            return;
        }
        $this->redirectTo('user', null, true);
    }
}
?>