<?php

class Conexao {
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "sinpsports";
    private $conexao;
    /*
    private $servidor = "localhost";
    private $usuario = "id3206094_root";
    private $senha = "p13m29m28";
    private $banco = "id3206094_sinpsports";
    private $conexao;
    */

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=$this->servidor;dbname=$this->banco", $this->usuario, $this->senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //  echo "Conectou !!! ";
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }
    
    //Retorna
    public function getConexao() {
        return $this->conexao;
    }
}

new Conexao();