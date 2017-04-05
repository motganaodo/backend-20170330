<?php 
/**
* 
*/
class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::init_model('user');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if (Authentication::is_login()) {
            redirect();
        }
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            // username is email
            $username = $_POST['username'];
            $password = $_POST['password'];
            $msg = array();

            if (filter_var($username, FILTER_VALIDATE_EMAIL) !== FALSE) {
                $user = $this->model->get_user('email', $username);
                if (!empty($user)) {
                    $sha_password = sha1($password);
                    if ($user['password'] == $sha_password) {
                        unset($user['password']);
                        $_SESSION['user'] = $user;
                        // Check if administrator
                        if(($user['role']+0) > 0) {
                            redirect('/admin/index');
                        }
                        redirect();
                    }else{
                        $msg = array(
                            'type' => 'info',
                            'content' => 'Login false'
                            );
                    }
                }
            }else{
                $msg = array(
                    'type' => 'error',
                    'content' => 'Email incorrect. Please try again'
                    );
            }
            $this->view->set('message', $msg);
        }
        $this->view->render('/user/form-login.php');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        redirect();
    }
}
?>