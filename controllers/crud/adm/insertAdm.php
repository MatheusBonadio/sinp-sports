<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/adm/email/mail.php';

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

$adm = new Administrador();
$dao = new AdministradorDAO();
$mail = new Mail();
$senha = $mail->gerarSenha();
$mail->configurarEmail($_POST['nome'], $_POST['email'], $senha, $_POST['adm_login']);

$adm->setidTorneio($_SESSION['torneio']);
$adm->setLogin($_POST['adm_login']);
$senha = md5($senha);
$adm->setSenha($senha);
$adm->setEmail($_POST['email']);
$adm->setNome($_POST['nome']);
$adm->setCargo($_POST['cargo']);

if(isset($_POST['permissao'])){
	$permissao = $_POST['permissao'];
	$dao->inserirPermissao($adm, $permissao);
}

$dao->inserir($adm);


header('location:selectAdm.php');