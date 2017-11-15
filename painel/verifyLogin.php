<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/dao/AdministradorDAO.php";
$dao = new AdministradorDAO();

$login = $_POST['login'];
$senha = $_POST['senha'];
$verifica = $dao->verificarLogin($login, $senha);

if($verifica){
	$_SESSION['permissao'] = $dao->consultarPermissao($login);
	$_SESSION['login'] = $login;
	header('location: painel.php');
}else{
	header('location: ../index.php');
}

