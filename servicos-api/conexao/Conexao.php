<?php
class Conexao
{
    private static $dsn = 'mysql:host=localhost;port=3306;dbname=dweb1';
    private static $usuario = 'root';
    private static $senha = 'root';
    private static $conexao = null;

    private static function conecta(){
        if(self::$conexao == null){
            self::$conexao = new PDO(
                self::$dsn,
                self::$usuario,
                self::$senha
            );
        }
    }

    public static function getConexao(){
        self::conecta();
        return self::$conexao;
    }

    public static function preparaComando($sql) {
        self::conecta();
        $preparado = self::$conexao->prepare($sql);
        return $preparado;
    }

}
