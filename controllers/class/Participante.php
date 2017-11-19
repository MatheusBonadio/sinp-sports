<?php

class Participante {

    private $idParticipante;
    private $idTorneio;
    private $idEquipe;
    private $nome;

    public function setidParticipante($idParticipante){
        $this->idParticipante = $idParticipante;
    }

    public function getidParticipante(){
        return $this->idParticipante;
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

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }
}