<?php
require_once './conexao/Conexao.php';
class ControleServico {
    
    public function listar() {
        $sql = 'select * from servicos';
        $todos = [];
        $preparado = Conexao::preparaComando($sql);
        if($preparado->execute()){
            $todos = $preparado->fetchAll(PDO::FETCH_ASSOC);
        }
        return $todos;
    }

    public function um() {
        $sql = 'select * from servicos where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $um = [];
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if($preparado->execute()){
            $um = $preparado->fetch(PDO::FETCH_ASSOC);
        }
        return $um;
    }

    public function inserir() {
        $sql = 
        'insert into servicos (jogo, descricao)
        values (?, ?)';
        $jogo = filter_input(INPUT_POST, 'jogo');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $jogo);
        $preparado->bindValue(2, $descricao);
        if($preparado->execute()){
            return ['status' => 'Serviço adicionado!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

    public function editar() {
        $sql = 
        'update servicos set jogo = ?, descricao = ?
        where id = ?;';
        $id = filter_input(INPUT_POST, 'id');
        $jogo = filter_input(INPUT_POST, 'jogo');
        $descricao = filter_input(INPUT_POST, 'descricao');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $jogo);
        $preparado->bindValue(2, $descricao);
        $preparado->bindValue(3, $id);
        if($preparado->execute()){
            return ['status' => 'Serviço modificado!'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

    public function excluir() {
        $sql = 'delete from servicos where id = ?';
        $id = filter_input(INPUT_POST, 'id');
        $preparado = Conexao::preparaComando($sql);
        $preparado->bindValue(1, $id);
        if($preparado->execute()){
            return ['status' => 'Serviço cancelado.'];
        } else {
            return ['status' => $preparado->errorInfo()];
        }        
    }

}