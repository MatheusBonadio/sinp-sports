<?php
	require_once '../../class/Fase.php';
	require_once '../../dao/FaseDAO.php';
	$fase = new Fase();
	$dao = new FaseDAO();

	$id = $_GET['id'];
	/*$fase->setDescricao($_POST['descricao']);
	$fase->setIndice($_POST['indice']);*/
	$dao->excluir($id);

	header('location:selectFase.php');
?>
