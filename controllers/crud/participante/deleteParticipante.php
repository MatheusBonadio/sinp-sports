<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();

	$id = $_GET['id'];
	/*$participante->setDescricao($_POST['descricao']);
	$participante->setIndice($_POST['indice']);*/
	$dao->excluir($id);

	header('location:selectParticipante.php');
?>
