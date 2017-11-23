<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
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
