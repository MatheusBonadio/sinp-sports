<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
	$adm = $dao->consultarLogin($_SESSION['login'], $_SESSION['torneio']);
?>
	<div class='container_header flex'>Trocar senha</div>
	<div class='container_body'>
	<form action="trocarSenha.php" method="POST">
		<input type="password" name="senha" placeholder='Digite a sua nova senha' required="">
		<input type="submit" value='Enviar'>
	</form>	
<?php
	if(isset($_POST['senha'])){
		$senha = md5($_POST['senha']);
		$dao->trocarSenha($senha, $_SESSION['login'], $_SESSION['torneio']);
		header("location: /painel/painel".$_SESSION['cargo'].".php");
	}
		
?>