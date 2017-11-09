<?php
	require_once '../../class/Torneio.php';
	require_once '../../dao/TorneioDAO.php';
	$torneio = new Torneio();
	$dao = new TorneioDAO();

	$torneio->setDescricao($_POST['descricao']);
	$torneio->setInicio($_POST['inicio']);
	$torneio->setTermino($_POST['termino']);

	$dao->inserir($torneio);

	header('location:selectTorneio.php');
?>
