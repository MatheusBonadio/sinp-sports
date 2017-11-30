<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Participante.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$dao->excluir($id);
	$dao->excluirParticipacao($id);


	header('location:selectParticipante.php');
?>
