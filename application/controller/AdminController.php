<?php 
/**
* 
*/
require( DIR_CONTROL . '/UserController.php' );

class AdminController extends UserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!Authentication::is_admin()) {
            redirect();
        }
        $users = $this->model->get_all_user($this->params['paged'], 12);

        $this->view->set('content', $users);
        $this->view->render('/admin/content.php');
    }
}
?>