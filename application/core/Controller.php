<?php
/**
* 
*/
class Controller
{
    protected $model;
    protected $view;
    protected $params;

    public function __construct($params = array())
    {
        $this->view = new View();

        $this->params['paged'] = 1;
        if (!empty($params)) {
            if ($params[0] == 'paged') {
                if (is_int($params[1]+0) && ($params[1]+0) > 1) {
                    $this->params['paged'] = $params[1];
                }
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