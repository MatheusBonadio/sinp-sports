<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Destaque.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/DestaqueDAO.php';
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/public/img/destaque/';

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$destaque = $dao->consultar($id);
	$imagem = $destaque->getImagem();
    unlink($diretorio.$imagem);

	$dao->excluir($id);

	header('location:selectDestaque.php');
?>
