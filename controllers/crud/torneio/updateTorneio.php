<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Torneio.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/TorneioDAO.php';
	$torneio = new Torneio();
	$dao = new TorneioDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$torneio->setidTorneio($_POST['id']);
	$torneio->setDescricao($_POST['descricao']);
	$torneio->setInicio($_POST['inicio']);
	$torneio->setTermino($_POST['termino']);

	$dao->alterar($torneio);

	header('location:selectTorneio.php');
?>
