<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/TorneioDAO.php';
	$dao = new TorneioDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	
	$dao->excluirAdm($id);
	$dao->excluirDestaque($id);
	$dao->excluirEquipe($id);
	$dao->excluirEsporte($id);
	$dao->excluirPartida($id);
	$dao->excluirParticipante($id);
	$dao->excluirClassificacao($id);
	$dao->excluir($id);
	
	header('location:selectTorneio.php');
?>
