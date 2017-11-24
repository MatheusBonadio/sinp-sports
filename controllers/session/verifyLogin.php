<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/AdministradorDAO.php";
$dao = new AdministradorDAO();

$login = $_POST['login'];
$senha = $_POST['senha'];
$verifica = $dao->verificarLogin($login, $senha);

if($verifica){
	$_SESSION['permissao'] = $dao->consultarPermissao($login);
	$_SESSION['cargo'] = $dao->consultarCargoLogin($login);
	$_SESSION['login'] = $login;

	if($_SESSION['cargo'] == 'Gerente'){
		header('location: ../../painel/painelGerente.php');
	}
	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../painel/painelAdministrador.php');
	}
	if($_SESSION['cargo'] == 'Representante'){
		header('location: ../../painel/painelRepresentante.php');
	}
}else{
	header('location: /errors/403.php');
}

