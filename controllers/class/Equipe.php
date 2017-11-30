<?php

class Equipe {

    private $idEquipe;
    private $idTorneio;
    private $nome;
    private $sigla;
    private $Ouro;
    private $prata;
    private $bronze;
    private $pontos;
    private $representante;
    private $logo;

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

    public function setOuro($Ouro){
        $this->Ouro = $Ouro;
    }

    public function getOuro(){
        return $this->Ouro;
    }

    public function setPrata($prata){
        $this->prata = $prata;
    }

    public function getPrata(){
        return $this->prata;
    }

    public function setBronze($bronze){
        $this->bronze = $bronze;
    }

    public function getBronze(){
        return $this->bronze;
    }

    public function setPontos($pontos){
        $this->pontos = $pontos;
    }

    public function getPontos(){
        return $this->pontos;
    }

    public function setRepresentante($representante){
        $this->representante = $representante;
    }

    public function getRepresentante(){
        return $this->representante;
    }

    public function setLogo($logo){
        $this->logo = $logo;
    }

    public function getLogo(){
        return $this->logo;
    }
}