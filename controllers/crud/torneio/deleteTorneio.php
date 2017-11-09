<?php
	//require_once '../../class/Torneio.php';
	require_once '../../dao/TorneioDAO.php';
	//$torneio = new Torneio();
	$dao = new TorneioDAO();

	$id = $_GET['id'];
	/*$torneio->setidTorneio($_POST['id']);
	$torneio->setDescricao($_POST['descricao']);
	$torneio->setInicio($_POST['inicio']);
	$torneio->setTermino($_POST['termino']);*/

	$dao->excluir($id);

	header('location:selectTorneio.php');
?>
