<?php

class Fase {

    private $idFase;
    private $idTorneio;
    private $descricao;
    private $indice;

    public function setidFase($idFase){
        $this->idFase = $idFase;
    }

    public function getidFase(){
        return $this->idFase;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setIndice($indice){
        $this->indice = $indice;
    }

    public function getIndice(){
        return $this->indice;
    }
}