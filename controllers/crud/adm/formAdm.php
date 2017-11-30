
<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/adm/Functions.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();
	$func = new Functions();
	

	if(!isset($_GET['cargo']) && !isset($_GET['id'])){
		header('location: /error/403');
	}else{
		if(!isset($_GET['id']))
		$cargoSel = $_GET['cargo'];
	}

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	if($_SESSION['cargo'] == 'Gerente'){

	if(!isset($_GET['id'])){
		if($cargoSel == 'Gerente' || $cargoSel == 'Representante'){
?>
<html>
<body>
			<form action="insertAdm.php" method="POST">
			<label><?php echo $cargoSel; ?></label><input type="text" name="cargo" value="<?php echo $cargoSel; ?>" hidden><br>
			login<input type="text" name="adm_login"><br>
			email<input type="text" name="email"><br>
			nome<input type="text" name="nome"><br>
			<input type="submit">
<?php
		}

		if($cargoSel == 'Administrador'){
?>
		<form action="insertAdm.php" method="POST">
			<label><?php echo $cargoSel; ?></label><input type="text" name="cargo" value="<?php echo $cargoSel; ?>" hidden><br>
			login<input type="text" name="adm_login"><br>
			email<input type="text" name="email"><br>
			nome<input type="text" name="nome"><br>
			permissao<br>
					<?php 
						$exec = $dao->consultarEsporte($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					?>
			<input type="submit">
		</form>
<?php
		}
	}
	else{
		$id = $_GET['id'];
		$adm = $dao->consultar($id);
		$exec = $dao->consultarPermissao($adm->getLogin());
		$idTorneio = $dao->consultarTorneioID($adm->getidTorneio());
			foreach ($exec as $listar) {
				$arrayChecked[$listar['id_esporte']] = $listar['id_esporte'];
			}

			if($adm->getCargo() == 'Gerente' || $adm->getCargo() == 'Representante'){
 ?>
		<form action="updateAdm.php" method="POST">
			<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?> " hidden>
			login<input type="text" name="login" value="<?php echo $adm->getLogin(); ?> "><br>
			senha<input type="text" name="senha" value="<?php echo $adm->getSenha(); ?> "><br>
			email<input type="text" name="email" value="<?php echo $adm->getEmail(); ?> "><br>
			nome<input type="text" name="nome" value="<?php echo $adm->getNome(); ?> "><br>
			<input type="submit">
		</form>	

<?php
		}else if($adm->getCargo() == 'Administrador'){
?>
		<form action="updateAdm.php" method="POST">
			<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?> " hidden>
			login<input type="text" name="login" value="<?php echo $adm->getLogin(); ?> "><br>
			senha<input type="text" name="senha" value="<?php echo $adm->getSenha(); ?> "><br>
			email<input type="text" name="email" value="<?php echo $adm->getEmail(); ?> "><br>
			nome<input type="text" name="nome" value="<?php echo $adm->getNome(); ?> "><br>
			permissao<br>
				<?php 
					$exec = $dao->consultarEsporte($_SESSION['torneio']);
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>' checked>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}else{
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					}
					?>
			<input type="submit">
		</form>	
<?php
		}
	}
}
?>
</body>
</html>