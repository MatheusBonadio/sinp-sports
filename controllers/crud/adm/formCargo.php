<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	require_once 'Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	$func = new Functions();

	$adm = $dao->consultar($_GET['id']);
?>

<form action="updateCargo.php" method="POST">
	<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?> " hidden>
	cargo<select name='cargo'>
		<?php echo $func->optionsCargo($adm); ?>
	</select><br>
	<input type="submit">
</form>