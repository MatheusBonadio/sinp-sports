<?php

class Torneio {

    private $idTorneio;
    private $descricao;
    private $inicio;
    private $termino;

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setInicio($inicio){
        $this->inicio = $inicio;
    }

    public function getInicio(){
        return $this->inicio;
    }

    public function setTermino($termino){
        $this->termino = $termino;
    }

    public function getTermino(){
        return $this->termino;
    }
}