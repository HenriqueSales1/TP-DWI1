<?php
require_once './conexao/Conexao.php';
class ControleUsuario
{

    public function um($email)
    {
        $sql = 'select * from usuario where email = ?';
        $um = [];
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $email);
        if ($preparado->execute()) {
            $um = $preparado->fetch(PDO::FETCH_ASSOC);
        }
        return $um;
    }

    public function padrao()
    {
        $sql =
            'insert into usuario (email, senha) values (?, ?)';
        $email = 'admin@admin.com';
        $senha = password_hash('admin', PASSWORD_ARGON2I);
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $email);
        $preparado->bindValue(2, $senha);
        if ($preparado->execute()) {
            return ['status' => 'Usuário padrão gerado.'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

}