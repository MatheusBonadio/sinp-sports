<?php

class Classificacao {

    private $idClassificacao;
    private $idTorneio;
    private $idEquipe;
    private $idEsporte;
    private $pontuacao;

    public function setidClassificacao($idClassificacao){
        $this->idClassificacao = $idClassificacao;
    }

    public function getidClassificacao(){
        return $this->idClassificacao; 
    }

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio; 
    }

    public function setidEquipe($idEquipe){
        $this->idEquipe = $idEquipe;
    }

    public function getidEquipe(){
        return $this->idEquipe;
    }

    public function setidEsporte($idEsporte){
        $this->idEsporte = $idEsporte;
    }

    public function getidEsporte(){
        return $this->idEsporte;
    }

    public function setPontuacao($pontuacao){
        $this->pontuacao = $pontuacao;
    }

    public function getPontuacao(){
        return $this->pontuacao;
    }
}