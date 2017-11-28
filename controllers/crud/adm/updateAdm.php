<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	session_start();

	$adm->setidAdm($_POST['id']);
	$adm->setidTorneio($_SESSION['torneio']);
	$adm->setLogin($_POST['login']);
	$adm->setSenha($_POST['senha']);
	$adm->setEmail($_POST['email']);
	$adm->setNome($_POST['nome']);
	

	if(isset($_POST['permissao'])){
		$permissao = $_POST['permissao'];
		$dao->excluirPermissao($adm->getLogin());
		$dao->inserirPermissao($adm, $permissao);
	}

	$dao->alterar($adm);

	header('location:selectAdm.php');
?>
