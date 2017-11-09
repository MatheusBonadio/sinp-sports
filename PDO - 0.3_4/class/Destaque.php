<?php

class Destaque {

    private $idDestaque;
    private $idPartida;
    private $texto;
    private $imagem;

    public function setidDestaque($idDestaque){
        $this->idDestaque = $idDestaque;
    }

    public function getidDestaque(){
        return $this->idDestaque; 
    }

    public function setidPartida($idPartida){
        $this->idPartida = $idPartida;
    }

    public function getidPartida(){
        return $this->idPartida;
    }

    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }
}