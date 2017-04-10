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
        $this->params['paged'] = 1;
    }

    public function set_page($params)
    {
        if (!empty($params) && preg_match('/^\d{1,9}$/', $params[0]) === 1) {
            $paged = $params[0]*1;
            if (is_int($paged) && $paged > 1) {
                $this->params['paged'] = $paged;
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