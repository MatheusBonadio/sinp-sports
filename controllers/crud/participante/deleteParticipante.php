<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	$id = $_GET['id'];
	/*$participante->setDescricao($_POST['descricao']);
	$participante->setIndice($_POST['indice']);*/
	$dao->excluir($id);
	$dao->excluirParticipacao($id);


	header('location:selectParticipante.php');
?>
