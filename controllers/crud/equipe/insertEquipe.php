<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	$equipe->setidTorneio($_SESSION['torneio']);
	$equipe->setNome($_POST['nome']);
	$equipe->setSigla($_POST['sigla']);
	$equipe->setRepresentante($_POST['representante']);

	$dao->inserir($equipe);

	header('location:selectEquipe.php');
?>
