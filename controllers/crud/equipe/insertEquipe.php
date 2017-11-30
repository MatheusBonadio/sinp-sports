<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Equipe.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$equipe->setidTorneio($_SESSION['torneio']);
	$equipe->setNome($_POST['nome']);
	$equipe->setSigla($_POST['sigla']);
	$equipe->setRepresentante($_POST['representante']);

	$dao->inserir($equipe);

	header('location:selectEquipe.php');
?>
