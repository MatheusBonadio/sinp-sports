<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	$participante->setidParticipante($_POST['id']);
	$participante->setidTorneio($_SESSION['torneio']);
	$participante->setNome($_POST['nome']);
	$participante->setidEquipe($_POST['equipe']);

	$dao->excluirParticipacao($participante->getidParticipante());
	$dao->inserirParticipacaoEsporte($participante->getidParticipante(), $_POST['idEsporte']);

	$dao->alterar($participante);

	header('location:selectParticipante.php');
?>
