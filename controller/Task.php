<?php
class Task extends App
{
    /**
     * @var Sesion Objeto que representa la sesión del usuario.
     * @var Task_model Objeto que representa el modelo de la tarea.
     * @var StandardizeData Objeto que representa la librería para normalizar datos.
     */
    private $Sesion, $Task_model, $StandardizeData;

    /**
     * Constructor de la clase Task.
     */
    public function __CONSTRUCT()
    {
        // instancia del modelo Task_model, el cual se utiliza para interactuar con la tabla tasks en la base de datos
        $this->Task_model = $this->model('Task_model');

        // instancia de la clase StandardizeData y de la clase sesion.
        $this->StandardizeData = $this->library('StandardizeData');
        $this->Sesion = $this->library('sesion');
    }

    /**
     * Método que muestra las tareas en la vista.
     * 
     * @return void
     */
    public function index()
    {
        if ($this->Sesion->isConnected()) {
            $this->view('head');
            $this->view('nav');
            $tasks = $this->Task_model->getTasks();
            $this->view('tasks', $tasks);
            $this->view('foot');
        } else
            $this->redirectTo();

    }

    /**
     * Método para crear una nueva tarea.
     * 
     * @return void
     */
    public function newTask()
    {
        if ($this->Sesion->isConnected()) {
            // Remueve los espacios en blanco en los campos del formulario.
            $_POST['titulo'] = $this->StandardizeData->removeBlankSpaces($_POST['titulo']);
            $_POST['detalle'] = $this->StandardizeData->removeBlankSpaces($_POST['detalle']);
            // Almacena la nueva tarea en la base de datos.
            $id = $this->Task_model->newTask($_SESSION['ID'], $_POST['titulo'], $_POST['detalle']);
            // Obtiene la tarea creada recientemente.
            $task = $this->Task_model->getTask($id);
            if ($task)
                // Devuelve la tarea creada en formato JSON.
                echo json_encode(
                    array(
                        'id' => $task['id'],
                        'titulo' => $task['titulo'],
                        'detalle' => $task['detalle'],
                        'fecha' => $task['fecha'],
                        'activo' => $task['activo'],
                    )
                );
            else
                // Devuelve falso en caso de que no se haya creado la tarea
                echo json_encode(false);
        } else
            // Devuelve falso en caso de que el usuario no esté conectado.
            echo json_encode(false);
    }

    /**
     * Método para actualizar una tarea existente.
     * 
     * @return void
     */
    public function setTask()
    {
        if ($this->Sesion->isConnected()) {
            $_POST['titulo'] = $this->StandardizeData->removeBlankSpaces($_POST['titulo']);
            $_POST['detalle'] = $this->StandardizeData->removeBlankSpaces($_POST['detalle']);
            $task = $this->Task_model->setTask($_POST['id'], $_POST['titulo'], $_POST['detalle'], $_POST['activo']);
            echo json_encode($task);
        } else
            echo json_encode(false);
    }

    /**
     * Método para eliminar una tarea existente.
     * 
     * @return void
     */
    public function removeTask()
    {
        if ($this->Sesion->isConnected()) {
            $task = $this->Task_model->removeTask($_POST['id']);
            echo json_encode($task);
        } else
            echo json_encode(false);
    }
}
?>