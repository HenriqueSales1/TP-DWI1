<?php
require_once './conexao/Conexao.php';
class ControlePrestadores
{

    public function listar()
    {
        $sql = 'select * from prestadores';
        $todos = [];
        $preparado = Conexao::preparaComando($sql);
        if ($preparado->execute()) {
            $todos = $preparado->fetchAll(PDO::FETCH_ASSOC);
        }
        return $todos;
    }

    public function um()
    {
        $sql = 'select * from prestadores where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $um = [];
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if ($preparado->execute()) {
            $um = $preparado->fetch(PDO::FETCH_ASSOC);
        }
        return $um;
    }

    public function inserir()
    {
        $sql =
            'insert into prestadores (nick, email, servico)
        values (?, ?, ?)';
        $nick = filter_input(INPUT_POST, 'nick');
        $email = filter_input(INPUT_POST, 'email');
        $servico = filter_input(INPUT_POST, 'servico');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $nick);
        $preparado->bindValue(2, $email);
        $preparado->bindValue(3, $servico);
        if ($preparado->execute()) {
            return ['status' => 'Prestador de serviço adicionado!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

    public function editar()
    {
        $sql =
            'update prestadores set nick = ?, email = ?, servico = ?
        where id = ?;';
        $id = filter_input(INPUT_POST, 'id');
        $nick = filter_input(INPUT_POST, 'nick');
        $email = filter_input(INPUT_POST, 'email');
        $servico = filter_input(INPUT_POST, 'servico');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $nick);
        $preparado->bindValue(2, $email);
        $preparado->bindValue(3, $servico);
        $preparado->bindValue(4, $id);
        if ($preparado->execute()) {
            return ['status' => 'Dados do prestador editados!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

    public function excluir()
    {
        $sql = 'delete from prestadores where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if ($preparado->execute()) {
            return ['status' => 'Prestador excluído.'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

}