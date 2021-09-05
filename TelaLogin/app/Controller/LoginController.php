<?php

    class LoginController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache',
                'auto_reload' => true,
            ]);
            $template = $twig->load('t_login.html');
            $parametro['error'] = $_SESSION['msg_error'] ?? null;

            return $template->render($parametro);
        }

        public function check()
        {
            try {
                $usuario = new Usuario;
                $usuario->__set('login',$_POST['login']);
                $usuario->__set('senha',$_POST['senha']);
   
                
                $usuario->validaLogin();
               header('Location: http://localhost/TelaLogin/acesso');                 
            } catch (\Exception $e) {
            $_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count' => 0);
              
                header('Location: http://localhost/TelaLogin');
            }
            
        }
    }
