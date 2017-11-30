<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/AdministradorDAO.php";
	$dao = new AdministradorDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$login = $_GET['login'];

	$dao->excluir($id);
	$dao->excluirPermissao($login);

	header('location:selectAdm.php');
?>
