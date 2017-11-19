<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();

	$participante->setidParticipante($_POST['id']);
	$participante->setidTorneio($_POST['torneio']);
	$participante->setNome($_POST['nome']);
	$participante->setidEquipe($_POST['equipe']);

	$participacao = $_POST['participacao'];
	
	$dao->excluirParticipacao($participante->getidParticipante());
	$dao->inserirParticipacao($participante, $participacao);
	$dao->alterar($participante);

	header('location:selectParticipante.php');
?>
