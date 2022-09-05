<?php 
class App {
	public function __construct(){
        
    }
    public function view($view, $data = null){
        if (file_exists("./view/" .$view. ".php")){
            
            require_once('./view/'.$view.'.php');
        } 
    }
    public function model($model){
        if (file_exists("./model/" .$model. ".php")){
            require_once "./model/" .$model. ".php";
            $model = new $model;
            return $model;
        }
    }
    public function library($library)
    {
        if (file_exists("./app/library/" .$library. ".php")){
            require_once "./app/library/" .$library. ".php";
            $library = new $library;
            return $library;
        }
    }

    public function redirectTo($c = DEFAULT_CONTROLLER, $a=null, $important=false)
    {
        if(CONTROLLER != $c || $important) header('Location: '.BASE_URL.$c.'/'.$a);
    }
    
}
?>