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
        if (!Authentication::is_admin()) {
            redirect('/404.html');
        }
    }

    public function index()
    {
        if (ceil($this->model->get_total() / $this->limit) < get_page()) {
            set_page(get_page() - 1);
        }
        
        $users = $this->model->get_all_user(get_page(), $this->limit);

        $this->view->set_content('users', $users);
        $this->view->set_content('total', $this->model->get_total());
        $this->view->set_content('paged', get_page());
        $this->view->set_content('limit', $this->limit);

        $this->view->render('/admin/list.php');
    }

    public function delete()
    {
        if (preg_match('/^\d+$/', $this->params[0])) {
            $count = $this->model->delete_user($this->params[0]);
            if ($count > 0) {
                echo json_encode(array(
                    'message' => 'Delete successful',
                    'redirect' => '/admin/index/'. get_page()
                    ));
            }else{
                echo json_encode(array(
                    'message' => 'Delete failed',
                    ));
            }
        }else{
            echo json_encode(array(
            'message' => 'An error occured. Please try again',
            ));
        }
    }
}
?>