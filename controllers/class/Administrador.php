<?php

class Administrador {

    private $idAdm;
    private $idTorneio;
    private $login;
    private $senha;
    private $email;
    private $nome;
    private $permissao;
    private $cargo;

    public function setidAdm($idAdm){
        $this->idAdm = $idAdm;
    }

    public function getidAdm(){
        return $this->idAdm; 
    }

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setPermissao($permissao){
        $this->permissao = $permissao;
    }

    public function getPermissao(){
        return $this->permissao;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function getCargo(){
        return $this->cargo;
    }

}