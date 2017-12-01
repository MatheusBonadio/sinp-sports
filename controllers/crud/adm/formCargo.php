<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/adm/Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	$func = new FunctionsAdministrador();

	
	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$adm = $dao->consultar($_GET['id']);
?>
<div class='container_header flex'>Cargo</div>
<div class='container_body'>
<form action="updateCargo.php" method="POST">
	<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?>" hidden>
	<select name='cargo'>
		<?php echo $func->optionsCargo($adm); ?>
	</select><br>
	<input type="submit" value='Enviar'>
</form>