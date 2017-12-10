<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
	

	$adm->setidAdm($_POST['id']);
	$adm->setidTorneio($_SESSION['torneio']);
	$adm->setLogin($_POST['login']);

	$senha = trim($_POST['senha']);
	
	$senhaAntiga = $dao->consultarSenhaAntiga($_POST['id']);
	if($senha != $senhaAntiga){
		$senha = md5($senha);
		$adm->setSenha($senha);
	}else{
		$adm->setSenha($senhaAntiga);
	}
	


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
