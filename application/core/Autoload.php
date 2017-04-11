<?php
/**
* 
*/
class Autoload
{
    protected $config;

    /**
     * @param array $config Get from cofig.php
     */
    public function __construct($config)
    {
        session_start();
        $this->config = $config;
    }

    /**
     * Make friendly url, handler client requests
     *
     * $controller_name
     * $method_name
     * $params
     * 
     * @return run classes method
     */
    public function run()
    {
        $request_args = explode('/', $_SERVER['REQUEST_URI']);

        // Validate controller
        if (!empty($request_args[1])) {
            if (preg_match('/^\w+$/', $request_args[1]) === 1) {
                if (in_array($request_args[1], $this->config['route'])) {
                    $controller_name = $request_args[1];

                    // Validate methods
                    $method_name = '';
                    $params = array();
                    if (!empty($request_args[2]) && preg_match('/^\w+$/', $request_args[2]) === 1) {
                        $method_name = $request_args[2];

                        // Validate parameters
                        if (!empty($request_args[3])) {
                            for ($i = 3; $i < count($request_args); $i++) {
                                if (preg_match('/^\w+$/', $request_args[$i]) === 1) {
                                    $params[] = $request_args[$i];
                                }
                            }
                        }
                    }
                    $this->init_controller($controller_name, $method_name, $params);
                }
            }
        }else{
            $this->init_controller('home', 'index');
        }
    }

    protected function init_controller($controller_name, $method_name, $params = array())
    {
        $controller_name = ucfirst(strtolower($controller_name));
        $controller_name = $controller_name . "Controller";
        $method_name = strtolower($method_name);

        if (include(DIR_CONTROL . '/' . $controller_name . '.php')) {
            $controller = new $controller_name();
            if (method_exists($controller, $method_name)) {
                $controller->set_params($params, $method_name);
                $controller->$method_name();
            }else{
                redirect('/404.html');
            }
        }else{
            redirect('/404.html');
        }
    }
}

?>