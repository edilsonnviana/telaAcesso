<?php 

class Usuario {

    private $login;
    private $senha;

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function validaLogin() {
        $conn = Database\Connection::getConn();
        $sql = 'SELECT login,senha 
            FROM usuario  ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':login', $this->login);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $result = $stmt->fetch();
            if ($result['senha'] === $this->senha) {
                $_SESSION['usr'] = array(
                    'usuario' => $result['login'],
                   
                );

                return true;
            }
        }
        throw new \Exception('Login Inválido');
    }

}