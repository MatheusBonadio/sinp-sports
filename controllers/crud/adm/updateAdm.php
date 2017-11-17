<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	$adm->setidAdm($_POST['id']);
	$adm->setidTorneio($_POST['torneio']);
	$adm->setLogin($_POST['login']);
	$adm->setSenha($_POST['senha']);
	$adm->setEmail($_POST['email']);
	$adm->setNome($_POST['nome']);
	$adm->setCargo($_POST['cargo']);
	$permissao = $_POST['permissao'];
	
	$dao->excluirPermissao($adm->getLogin());
	$dao->inserirPermissao($adm, $permissao);
	$dao->alterar($adm);

	header('location:selectAdm.php');
?>
