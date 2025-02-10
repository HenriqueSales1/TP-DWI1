<?php
require_once './controles/ControleUsuario.php';

class ControleAutenticacao
{
    public static function login()
    {
        $arr['logged'] = false;
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        $constroleUsuario = new ControleUsuario();
        $usuario = $constroleUsuario->um($email);
        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['logado'] = true;
                $_SESSION['email'] = $email;
                $arr['logged'] = true;
            }
        }
        return $arr;
    }

    public static function logout()
    {
        session_destroy();
        return ['logged' => false];
    }

    public static function check()
    {
        $arr['logged'] = false;
        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
            $arr['logged'] = true;
        }
        return $arr;
    }

    public static function padrao() {
        return (new ControleUsuario())->padrao();
    }
}
