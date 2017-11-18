<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();

	$equipe->setidTorneio($_POST['torneio']);
	$equipe->setNome($_POST['nome']);
	$equipe->setSigla($_POST['sigla']);

	$dao->inserir($equipe);

	header('location:selectEquipe.php');
?>
