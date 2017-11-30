<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/adm/Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	$func = new Functions();

	
	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$adm = $dao->consultar($_GET['id']);
?>

<form action="updateCargo.php" method="POST">
	<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?> " hidden>
	cargo<select name='cargo'>
		<?php echo $func->optionsCargo($adm); ?>
	</select><br>
	<input type="submit">
</form>