<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Equipe.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	error_reporting(0);

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$equipe = $dao->consultar($id, $_SESSION['torneio']);
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/public_html/public/img/equipe/';
	

	$exec = $dao->consultarParticipantes($id, $_SESSION['torneio']);
	$dao->excluirParticipante($exec);
	$dao->excluirParticipacao($exec);

	$dao->excluir($id);
	$dao->excluirRepresentante($equipe->getRepresentante(), $_SESSION['torneio']);
    unlink($diretorio.$equipe->getLogo());
	
	header('location:selectEquipe.php');
?>
