<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$dao = new ParticipanteDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	var_dump($_POST['participacao']);
	$dao->inserirParticipacao($_POST['participacao'], $_POST['esporte']);

	header('location:selectParticipante.php');
?>
