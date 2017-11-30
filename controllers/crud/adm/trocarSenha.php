<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/adm/Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
	$adm = $dao->consultarLogin($_SESSION['login'], $_SESSION['torneio']);

?>
		<form action="trocarSenha.php" method="POST">
			senha<input type="text" name="senha" value="<?php echo $adm->getSenha(); ?> "><br>
			<input type="submit">
		</form>	
<?php
	if(isset($_POST['senha'])){
		$trim = trim($_POST['senha']);
		$senha = md5($trim);
		$dao->trocarSenha($senha, $_SESSION['login'], $_SESSION['torneio']);
		header("location: /painel/painel".$_SESSION['cargo'].".php");
	}
		
?>