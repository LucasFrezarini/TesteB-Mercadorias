<?php

/**
 * Classe utilizada para receber a conexão com o banco de dados.
 */
class Conector {
    public static $host = "localhost";
    public static $usuario = "root";
    public static $senha = "";
    public static $banco = "bd_testeb"; 
    /**
     * Função utilizada para abrir uma conexão com o banco de dados.
     * @return mysqli Uma conexão mysqli aberta.
     */
    public static function getConexao(){
        $conexao = new mysqli(self::$host, self::$usuario, self::$senha, self::$banco);
        return $conexao;
    }
}

?>

