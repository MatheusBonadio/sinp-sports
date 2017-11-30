<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Participante.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ParticipanteDAO.php';
	$dao = new ParticipanteDAO();
	

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	var_dump($_POST['participacao']);
	$dao->inserirParticipacao($_POST['participacao'], $_POST['esporte']);

	header('location:selectParticipante.php');
?>
