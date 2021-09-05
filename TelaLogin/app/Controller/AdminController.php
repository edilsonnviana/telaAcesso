<?php

class AdminController {
    public function index() {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);
        $template = $twig->load('t_acesso.html');
        $parametro['usuario'] = $_SESSION['usr']['usuario'];
     
        return $template->render($parametro);
    }
    public function logout() {
        unset($_SESSION['usr']);
        session_destroy();
        header('Location: http://localhost/TelaLogin');
    }

}
