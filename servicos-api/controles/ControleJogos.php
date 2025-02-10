<?php
require_once './conexao/Conexao.php';
class ControleJogos
{

    public function listar()
    {
        $sql = 'select * from jogos';
        $todos = [];
        $preparado = Conexao::preparaComando($sql);
        if ($preparado->execute()) {
            $todos = $preparado->fetchAll(PDO::FETCH_ASSOC);
        }
        return $todos;
    }

    public function um()
    {
        $sql = 'select * from jogos where id = ?';
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
            'insert into jogos (jogo) values (?)';
        $jogo = filter_input(INPUT_POST, 'jogo');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $jogo);
        if ($preparado->execute()) {
            return ['status' => 'Jogo adicionado!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

    public function editar()
    {
        $sql =
            'update jogos set jogo = ? where id = ?;';
        $id = filter_input(INPUT_POST, 'id');
        $jogo = filter_input(INPUT_POST, 'jogo');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $jogo);
        $preparado->bindValue(3, $id);
        if ($preparado->execute()) {
            return ['status' => 'Jogo modificado!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

    public function excluir()
    {
        $sql = 'delete from jogos where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if ($preparado->execute()) {
            return ['status' => 'Jogo removido.'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }
    }

}