<?php

class Partida {

    private $idPartida;
    private $idEquipeA;
    private $idEquipeB;
    private $idEsporte;
    private $idFase;
    private $idTorneio;
    private $dia;
    private $inicio;
    private $placarA;
    private $placarB;
    private $vencedor;

    public function setidPartida($idPartida){
        $this->idPartida = $idPartida;
    }

    public function getidPartida(){
        return $this->idPartida; 
    }

    public function setidEquipeA($idEquipeA){
        $this->idEquipeA = $idEquipeA;
    }

    public function getidEquipeA(){
        return $this->idEquipeA; 
    }

    public function setidEquipeB($idEquipeB){
        $this->idEquipeB = $idEquipeB;
    }

    public function getidEquipeB(){
        return $this->idEquipeB; 
    }

    public function setidEsporte($idEsporte){
        $this->idEsporte = $idEsporte;
    }

    public function getidEsporte(){
        return $this->idEsporte; 
    }

    public function setidFase($idFase){
        $this->idFase = $idFase;
    }

    public function getidFase(){
        return $this->idFase; 
    }

    public function setidTorneio($idTorneio){
        $this->idTorneio = $idTorneio;
    }

    public function getidTorneio(){
        return $this->idTorneio; 
    }

    public function setDia($dia){
        $this->dia = $dia;
    }

    public function getDia(){
        return $this->dia; 
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

    public function setPlacarA($placarA){
        $this->placarA = $placarA;
    }

    public function getPlacarA(){
        return $this->placarA; 
    }

    public function setPlacarB($placarB){
        $this->placarB = $placarB;
    }

    public function getPlacarB(){
        return $this->placarB; 
    }

    public function setVencedor($vencedor){
        $this->vencedor = $vencedor;
    }

    public function getVencedor(){
        return $this->vencedor; 
    }
}