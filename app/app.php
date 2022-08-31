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
    
}
?>