<?php 
/**
* 
*/
class UserController extends Controller
{
    protected $limit = 9;

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

            if (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
                $user = $this->model->get_user('email', $username);
                if (!empty($user)) {
                    $sha_password = sha1($password);
                    if ($user['password'] == $sha_password) {
                        $_SESSION['user'] = $user;
                        // Check if administrator
                        if(($user['role']+0) > 0) {
                            redirect('/admin/index');
                        }
                        redirect('/user/profile');
                    }else{
                        $msg = array(
                            'type' => 'info',
                            'content' => 'Wrong email or password'
                            );
                    }
                }else{
                    $msg = array(
                    'type' => 'error',
                    'content' => 'Wrong email or password'
                    );
                }
            }else{
                $msg = array(
                    'type' => 'error',
                    'content' => 'Email incorrect. Please try again'
                    );
            }
            $this->view->set_content('message', $msg);
        }
        $this->view->render('/user/form-login.php');
    }

    public function logout($redirect = '/')
    {
        foreach ($_SESSION as $name => $value) {
            unset($_SESSION[$name]);
        }
        redirect($redirect);
    }

    public function signup()
    {
        if (Authentication::is_login()) {
            $this->logout('/user/signup');
        }
        if (!empty($_POST)) {
            $validate = true;
            $msg = array(
                'type' => 'error',
                'content' => '',
                );
            // validate name
            if (!empty($_POST['name'])) {
                $name = trim($_POST['name']);
                $name = preg_replace('/\s+/', ' ', $name);
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                if (preg_match('/^(\w+\s?)+$/', $name) === 1) {
                    if (strlen($name) > 150) {
                        $validate = false;
                        $msg['content'][] = 'The name must less than 150 characters';
                    }
                }else{
                    $validate = false;
                    $msg['content'][] = 'Name invalid';
                }
            }else{
                $validate = false;
                $msg['content'][] = 'Name cannot be blank';
            }
            // validate email
            if (!empty($_POST['email'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                    $validate = false;
                    $msg['content'][] = 'Email invalid';
                }else{
                    $user = $this->model->get_user('email', $_POST['email']);
                    if (!empty($user)) {
                        $validate = false;
                        $msg['content'][] = 'Email already register';
                    }
                }
            }else{
                $validate = false;
                $msg['content'][] = 'Email cannot be blank';
            }
            // validate birthdate
            if (!empty($_POST['birthdate'])) {
                $birthdate = preg_replace('/\s+/', '', $_POST['birthdate']);
                list($dd, $mm, $yyyy) = explode('/', $birthdate);
                if (!checkdate($mm, $dd, $yyyy)) {
                    $validate = false;
                    $msg['content'][] = 'Birthday invalid';
                }
            }else{
                $validate = false;
                $msg['content'][] = 'Birthday cannot be blank';
            }
            // validate password
            if (!empty($_POST['password']) && !empty($_POST['re-password'])) {
                if ($_POST['password'] != $_POST['re-password']) {
                    $validate = false;
                    $msg['content'][] = "The password and confirm password doesn't match";
                }
            }else{
                $validate = false;
                $msg['content'][] = 'The password and confirm password cannot be blank';
            }
            if ($validate) {
                // $name above
                $email = $_POST['email'];
                $birthdate = implode('/', array($yyyy, $mm, $dd));
                $password = $_POST['password'];

                $result = $this->model->create_user($name, $email, $birthdate, $password);

                if ($result > 0) {
                    $msg['content']['type'] = 'success';
                    $msg['content'][] = 'Signup successful';
                    redirect();
                }else{
                    $msg['content'][] = 'An error occurred';
                } 
            }
            $this->view->set_content('message', $msg);
        }
        $this->view->set_content('title', 'signup');
        $this->view->render('/user/signup.php');
    }

    public function profile()
    {
        if (!Authentication::is_login()) {
            $this->logout('/user/login');
        }

        $msg = array();
        $user = $_SESSION['user'];
        if (!empty($_POST)) {
            $validate = true;
            $msg['type'] = 'error';

            // Validate username
            if (!empty($_POST['username'])) {
                $name = trim($_POST['username']);
                $name = preg_replace('/\s+/', ' ', $name);
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                if (preg_match('/^(\w+\s?)+$/', $name) === 1) {
                    if (strlen($name) > 150) {
                        $validate = false;
                        $msg['content'][] = 'The name must less than 150 characters';
                    }
                }else{
                    $validate = false;
                    $msg['content'][] = 'Name invalid';
                }
            }else{
                $validate = false;
                $msg['content'][] = 'Name cannot be blank';
            }

            // validate birthdate
            if (!empty($_POST['birthdate'])) {
                $birthdate = preg_replace('/\s+/', '', $_POST['birthdate']);
                list($dd, $mm, $yyyy) = explode('/', $birthdate);
                if (!checkdate($mm, $dd, $yyyy)) {
                    $validate = false;
                    $msg['content'][] = 'Birthday invalid';
                }
            }else{
                $validate = false;
                $msg['content'][] = 'Birthday cannot be blank';
            }

            // validate password
            if (!empty($_POST['old-password']) && !empty($_POST['new-password']) && !empty($_POST['re-password'])) {
                if (sha1($_POST['old-password']) != $user['password']) {
                    $validate = false;
                    $msg['content'][] = 'Old password wrong';
                }
                if ($_POST['new-password'] != $_POST['re-password']) {
                    $validate = false;
                    $msg['content'][] = "The new password and confirm password doesn't match";
                }
            }elseif (!empty($_POST['new-password'])) {
                $validate = false;
                $msg['content'][] = 'One of three password fields cannot be blank';
            }

            if ($validate) {
                $birthdate = implode('/', array($yyyy, $mm, $dd));
                $password = $_POST['new-password'];
     
                $result = $this->model->update_user($user['id'], $name, $birthdate, $password);
                if ($result > 0) {
                    $msg['type'] = 'success';
                    $msg['content'] = 'Update success';
                    $_SESSION['user'] = $this->model->get_user('id', $user['id']);
                    redirect('/user/profile');
                }else{
                    $msg['content'] = 'Update failed';
                }
            }
        }

        $this->view->set_content('user', $user);
        $this->view->set_content('title', 'Profile');
        $this->view->set_content('message', $msg);

        $this->view->render('/user/profile.php');
    }
}
?>