<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Esporte.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
$esporte = new Esporte();
$dao = new EsporteDAO();


	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

$id = $_GET['id'];
$esporte = $dao->consultar($id);
$imagem = $esporte->getImagem();
unlink('/public/img/esporte/'.$imagem);

$dao->excluir($id);

header('location:selectEsporte.php');