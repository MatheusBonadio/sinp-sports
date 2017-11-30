<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ClassificacaoDAO.php';
$dao = new ClassificacaoDAO();


	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

$dao->excluir($_GET['id']);

header('location:selectClassificacao.php');