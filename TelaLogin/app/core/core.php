
<?php

class Core {

    private $url;
    private $controller;
    private $method = 'index';
    private $params = array();
    private $usuario;
    private $error;

    public function __construct() {
        $this->usuario = $_SESSION['usr'] ?? null;
        $this->error = $_SESSION['msg_error'] ?? null;

        if (isset($this->error)) {
            if ($this->error['count'] === 0) {
                $_SESSION['msg_error']['count'] ++;
            } else {
                unset($_SESSION['msg_error']);
            }
        }
    }

    public function start($request) {
        if (isset($request['url'])) {
            $this->url = explode('/', $request['url']);

            $this->controller = ucfirst($this->url[0]) . 'Controller';
            array_shift($this->url);

            if (isset($this->url[0]) && $this->url != '') {
                $this->method = $this->url[0];
                array_shift($this->url);

                if (isset($this->url[0]) && $this->url != '') {
                    $this->params = $this->url;
                }
            }
        }

        if ($this->usuario) {
            $acesso = ['AdminController'];

            if (!isset($this->controller) || !in_array($this->controller, $acesso)) {
                $this->controller = 'AdminController';
 
            }
        } else {
            $acesso = ['LoginController'];

            if (!isset($this->controller) || !in_array($this->controller, $acesso)) {
                $this->controller = 'LoginController';
                $this->method = 'index';
            }
        }
   	if (isset($request['id']) && $request['id'] != null) {
				$id = $request['id'];
			} else {
				$id = null;
			}
   

        
  return call_user_func(array(new $this->controller, $this->method),
                array('id'=> $id));
                
   
    }

}
