<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Fase.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/FaseDAO.php';
	$fase = new Fase();
	$dao = new FaseDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$dao->excluir($id);

	header('location:selectFase.php');
?>
