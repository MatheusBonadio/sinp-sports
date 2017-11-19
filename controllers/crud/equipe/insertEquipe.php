<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();

	$equipe->setidTorneio($_POST['torneio']);
	$equipe->setNome($_POST['nome']);
	$equipe->setSigla($_POST['sigla']);
	$selecaoEsporte = $_POST['selecaoEsporte'];
													//passar por sessao
	//$dao->inserirSelecao($equipe, $selecaoEsporte, $_POST['torneio']);
	$dao->inserir($equipe);

	header('location:selectEquipe.php');
?>
