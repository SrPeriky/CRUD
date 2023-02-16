<?php
/**
 * 
 */
class App
{
    /**
     * Crea una nueva instancia de la clase
     */
    public function __construct()
    {

    }

    /**
     * Carga la vista indicada con los datos proporcionados (opcional).
     * 
     * @param string $view Nombre de la vista a cargar.
     * @param mixed $data (opcional) Datos que se pasan a la vista.
     * @return void
     */
    public function view($view, $data = null)
    {
        if (file_exists("./view/" . $view . ".php")) {
            require_once('./view/' . $view . '.php');
        }
    }

    /**
     * Carga el modelo indicado y crea una instancia de la clase correspondiente.
     * 
     * @param string $model Nombre del modelo a cargar.
     * @return object Instancia de la clase del modelo cargado.
     */
    public function model($model)
    {
        if (file_exists("./model/" . $model . ".php")) {
            require_once "./model/" . $model . ".php";
            $model = new $model;
            return $model;
        }
    }

    /**
     * Carga la librería indicada y crea una instancia de la clase correspondiente.
     * 
     * @param string $library Nombre de la librería a cargar.
     * @return object Instancia de la clase de la librería cargada.
     */
    public function library($library)
    {
        if (file_exists("./app/library/" . $library . ".php")) {
            require_once "./app/library/" . $library . ".php";
            $library = new $library;
            return $library;
        }
    }

    /**
     * Redirige a una página indicada por controlador y acción.
     * 
     * @param string $c (opcional) Nombre del controlador.
     * @param string $a (opcional) Nombre de la acción.
     * @param boolean $important (opcional) Si es verdadero, la redirección se hace aunque el controlador sea el actual.
     * @return void
     */
    public function redirectTo($c = DEFAULT_CONTROLLER, $a = null, $important = false)
    {
        if (CONTROLLER != $c || $important)
            header('Location: ' . BASE_URL . $c . '/' . $a);
    }
}
?>