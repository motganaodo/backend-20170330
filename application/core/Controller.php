<?php
/**
* 
*/
class Controller
{
    protected $model;
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public init_model($model_name) {
        $model_name = ucfirst(strtolower($model_name)) . 'Model';
        include(DIR_MODEL . '/' . $model_name . '.php');
        $this->model = new $model_name();
    }

    public function notfound($redirect_url)
    {
        $this->view->render($redirect_url);
    }
    
}

?>