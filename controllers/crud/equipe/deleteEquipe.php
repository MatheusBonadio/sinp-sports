<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();

	$id = $_GET['id'];
	
	/*$equipe->setNome($_POST['nome']);
	$equipe->setVitorias($_POST['vitorias']);
	$equipe->setEmpate($_POST['empates']);
	$equipe->setDerrotas($_POST['derrotas']);
	$equipe->setPontos($_POST['pontos']);*/

	$dao->excluir($id);

	header('location:selectEquipe.php');
?>
