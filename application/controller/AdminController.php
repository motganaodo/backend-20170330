<?php 
/**
* 
*/
class AdminController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model->init_model('user');
    }

    public function index()
    {
        $this->view->render('/admin/content.php');
    }

    public function login()
    {
        if (!empty($_POST)) {
            
        }else{
            $this->view->render('/admin/form-login.php');
        }
    }
}
?>