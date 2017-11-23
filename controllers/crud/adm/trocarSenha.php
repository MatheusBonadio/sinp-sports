<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	require_once 'Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	$adm = $dao->consultarLogin($_SESSION['login'], $_SESSION['torneio']);

?>
		<form action="trocarSenha.php" method="POST">
			senha<input type="text" name="senha" value="<?php echo $adm->getSenha(); ?> "><br>
			<input type="submit">
		</form>	
<?php
	if(isset($_POST['senha'])){
		$dao->trocarSenha($_POST['senha'], $_SESSION['login'], $_SESSION['torneio']);
		header("location: ../../../painel/painel".$_SESSION['cargo'].".php");
	}
		
?>