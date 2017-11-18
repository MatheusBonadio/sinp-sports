<?php

class Esporte {

    private $idEsporte;
    private $idTorneio;
    private $esporte;
    private $genero;
    private $tipo;
    private $qtdJogadores;
    private $classificacao;

    public function setidEsporte($idEsporte){
        $this->idEsporte = $idEsporte;
    }

    public function getidEsporte(){
        return $this->idEsporte; 
    }

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio; 
    }

    public function setEsporte($esporte){
        $this->esporte = $esporte;
    }

    public function getEsporte(){
        return $this->esporte;
    }

    public function setGenero($genero){
        $this->genero = $genero;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setqtdJogadores($qtdJogadores){
        $this->qtdJogadores = $qtdJogadores;
    }

    public function getqtdJogadores(){
        return $this->qtdJogadores;
    }

    public function setClassificacao($classificacao){
        $this->classificacao = $classificacao;
    }

    public function getClassificacao(){
        return $this->classificacao;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }
}