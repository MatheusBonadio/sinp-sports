<?php

class Equipe {

    private $idEquipe;
    private $idTorneio;
    private $nome;
    private $sigla;
    private $vitorias;
    private $empates;
    private $derrotas;
    private $pontos;

    public function setidEquipe($idEquipe){
        $this->idEquipe = $idEquipe;
    }

    public function getidEquipe(){
        return $this->idEquipe;
    }

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setSigla($sigla){
        $this->sigla = $sigla;
    }

    public function getSigla(){
        return $this->sigla;
    }

    public function setVitorias($vitorias){
        $this->vitorias = $vitorias;
    }

    public function getVitorias(){
        return $this->vitorias;
    }

    public function setEmpates($empates){
        $this->empates = $empates;
    }

    public function getEmpates(){
        return $this->empates;
    }

    public function setDerrotas($derrotas){
        $this->derrotas = $derrotas;
    }

    public function getDerrotas(){
        return $this->derrotas;
    }

    public function setPontos($pontos){
        $this->pontos = $pontos;
    }

    public function getPontos(){
        return $this->pontos;
    }
}