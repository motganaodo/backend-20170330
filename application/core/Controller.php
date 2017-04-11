<?php
/**
* 
*/
class Controller
{
    protected $model;
    protected $view;
    protected $params;

    public function __construct()
    {
        $this->view = new View();
        $this->params[0] = 1;
    }

    public function set_params($params)
    {
        if (!empty($params)) {
            $this->params = $params;
        }
    }

    public function init_model($model_name) {
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