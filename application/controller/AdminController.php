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
        $users = $this->model->get_all_user($this->params['paged'], $this->limit);

        $this->view->set_content('users', $users);
        $this->view->set_content('total', $this->model->get_total());
        $this->view->set_content('paged', $this->params['paged']);
        $this->view->set_content('limit', $this->limit);

        $this->view->render('/admin/list.php');
    }

    public function edit()
    {
        if (!Authentication::is_admin()) {
            redirect();
        }
        $this->view->set_content('title', 'Edit user');
        $this->view->render('/admin/user-info.php');
    }

    public function delete()
    {
        if (!Authentication::is_admin()) {
            redirect();
        }

    }
}
?>