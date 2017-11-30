<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	
	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$adm->setidAdm($_POST['id']);
	$adm->setCargo($_POST['cargo']);

	$dao->alterarCargo($adm);

	header('location:selectAdm.php');
?>