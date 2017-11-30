<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/AdministradorDAO.php";
$dao = new AdministradorDAO();

$login = $_POST['login'];
	$trim = trim($_POST['senha']);
	$senha = md5($trim);
$_SESSION['cargo'] = $dao->consultarCargoLogin($login);
if($_SESSION['cargo'] == 'Gerente'){
	$verifica = $dao->verificarGerente($login, $senha);
}else{
	$verifica = $dao->verificarLogin($login, $senha, $_SESSION['torneio']);
}


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
	header('location: /error/403');
}

