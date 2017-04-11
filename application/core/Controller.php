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
    }

    public function set_params($params, $method = '')
    {
        if (!empty($params)) {
            $this->params = $params;
            // Set paged
            if (preg_match('/^\d{1,9}$/', $params[0]) && in_array($method, array('index', 'list'))) {
                set_page($params[0]);
            }
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