<?php
	//require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	//$adm = new Administrador();
	$dao = new AdministradorDAO();

	$id = $_GET['id'];
	$login = $_GET['login'];

	/*$adm->setidAdm($_POST['id']);
	$adm->setidTorneio($_POST['torneio']);
	$adm->setLogin($_POST['login']);
	$adm->setSenha($_POST['senha']);
	$adm->setEmail($_POST['email']);
	$adm->setNome($_POST['nome']);*/

	$dao->excluir($id);
	$dao->excluirPermissao($login);

	header('location:selectAdm.php');
?>
