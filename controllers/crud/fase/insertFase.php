<?php
	require_once '../../class/Fase.php';
	require_once '../../dao/FaseDAO.php';
	$fase = new Fase();
	$dao = new FaseDAO();

	$fase->setDescricao($_POST['descricao']);
	$fase->setIndice($_POST['indice']);

	$dao->inserir($fase);

	header('location:selectFase.php');
?>
