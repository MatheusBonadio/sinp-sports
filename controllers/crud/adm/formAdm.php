
<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Administrador.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
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

	?>
	<div class='container_header flex'>Administrador</div>
	<div class='container_body'>
<?php if($_SESSION['cargo'] == 'Gerente'){

	if(!isset($_GET['id'])){
		if($cargoSel == 'Gerente' || $cargoSel == 'Representante'){
?>
		<form action="insertAdm.php" method="POST">
			<input type="text" name="cargo" value="<?php echo $cargoSel; ?>" hidden>
			<input type="text" name="adm_login" placeholder='Digite seu login' required>
			<input type="text" name="email" placeholder='Digite seu email' required>
			<input type="text" name="nome" placeholder='Digite seu nome' required>
			<input type="submit" value='Enviar'>
<?php
		}

		if($cargoSel == 'Administrador'){
?>
		<form action="insertAdm.php" method="POST">
			<input type="text" name="cargo" value="<?php echo $cargoSel; ?>" hidden>
			<input type="text" name="adm_login" placeholder='Digite seu login' required>
			<input type="text" name="email" placeholder='Digite seu email' required>
			<input type="text" name="nome" placeholder='Digite seu nome' required>
			<div class='container_checkbox'>
					<?php 
						$exec = $dao->consultarEsporte($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<div class='group_check'>
							<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
							<label><?php echo $listar['esporte']; ?></label>
						</div>
					<?php
						}
					?>
			</div>
			<input type="submit" value='Enviar'>
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
			<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?>" hidden>
			<input type="text" name="login" value="<?php echo $adm->getLogin(); ?>" hidden>
			<input type="password" name="senha" value="<?php echo $adm->getSenha(); ?>" placeholder='Digite sua senha' required>
			<input type="text" name="email" value="<?php echo $adm->getEmail(); ?>" placeholder='Digite seu email' required>
			<input type="text" name="nome" value="<?php echo $adm->getNome(); ?>" placeholder='Digite seu nome' required>
			<input type="submit" value='Enviar'>
		</form>	

<?php
		}else if($adm->getCargo() == 'Administrador'){
?>
		<form action="updateAdm.php" method="POST">
			<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?>" hidden>
			<input type="text" name="login" value="<?php echo $adm->getLogin(); ?>" hidden><br>
			<input type="password" name="senha" value="<?php echo $adm->getSenha(); ?>" placeholder='Digite sua senha' required>
			<input type="text" name="email" value="<?php echo $adm->getEmail(); ?>" placeholder='Digite seu email' required>
			<input type="text" name="nome" value="<?php echo $adm->getNome(); ?>" placeholder='Digite seu nome' required>
			<div class='container_checkbox'>
				<?php 
					$exec = $dao->consultarEsporte($_SESSION['torneio']);
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<div class='group_check'>
							<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>' checked>
							<label><?php echo $listar['esporte']; ?></label>
						</div>
					<?php
						}else{
					?>
						<div class='group_check'>
							<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
							<label><?php echo $listar['esporte']; ?></label>
						</div>
					<?php
						}
					}
					?>
				</div>
			<input type="submit" value='Enviar'>
		</form>	
<?php
		}
	}
}
?>
		</body>