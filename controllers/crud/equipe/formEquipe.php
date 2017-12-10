<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Equipe.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

?>
	<div class='container_header flex'>Equipe</div>
	<div class='container_body'>
<?php if(!isset($_GET['id']) && $_SESSION['cargo'] != 'Representante'){ ?>
		<form action="insertEquipe.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="nome" placeholder='Digite o nome da equipe' required>
			<input type="text" name="sigla" maxlength="6" placeholder='Digite a sigla da equipe' required>
			<select name="representante" required>
				<option selected disabled hidden value=''>Selecione um representante</option>
				<?php
					$exec = $dao->consultarRepresentantes($_SESSION['torneio']);
					foreach ($exec as $listar) {				
				?>
					<option value="<?php echo $listar['login'];?>"><?php echo $listar['nome']; ?></option>
				<?php
					}
				?>
			</select>
			<input type="submit" value='Enviar'>
		</form>
	
<?php 
	}
	else{
		$id = $_GET['id'];
		$equipe = $dao->consultar($id, $_SESSION['torneio']);
		if($_SESSION['cargo'] == 'Representante'){
 ?>
		<form action="updateEquipe.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="id" value="<?php echo $equipe->getidEquipe(); ?>" hidden>
			<input type="text" name="representante" value="<?php echo $equipe->getRepresentante(); ?>" hidden>
			<input type="text" name="nome" value="<?php echo $equipe->getNome(); ?>" placeholder='Digite o nome da equipe' required>
			<input type="text" name="sigla" maxlength="6" value="<?php echo $equipe->getSigla(); ?>" placeholder='Digite a sigla da equipe' required>
			<div class='container_img'>
				<div class='select_img' style='background-image: url(/public/img/equipe/<?php echo $equipe->getLogo(); ?>)'></div>
				<input type="file" name="logo" id='logo' accept="image/*" hidden>
				<label for='logo'>Selecione uma imagem</label>
			</div>
			<input type="submit" value='Enviar'>
		</form>
<?php
		}else if($_SESSION['cargo'] == 'Gerente'){
?>
		<form action="updateEquipe.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="id" value="<?php echo $equipe->getidEquipe(); ?>" hidden>
			<input type="text" name="nome" value="<?php echo $equipe->getNome(); ?>" placeholder='Digite o nome da equipe' required>
			<input type="text" name="sigla" maxlength="6" value="<?php echo $equipe->getSigla(); ?>" placeholder='Digite a sigla da equipe' required>
			<select name='representante'>
					<?php 
						$exec = $dao->consultarRepresentantes($_SESSION['torneio']);
						foreach ($exec as $listar) {
							if($listar['login'] == $equipe->getRepresentante()){
					?>
								<option value="<?php echo $listar['login'];?>" selected><?php echo $listar['nome']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['login'];?>"><?php echo $listar['nome']; ?></option>
					<?php
							}
						}
					?>
					</select>
			<div class='container_img'>
				<div class='select_img' style='background-image: url(/public/img/equipe/<?php echo $equipe->getLogo(); ?>)'></div>
				<input type="file" name="logo" id='logo' accept="image/*" hidden>
				<label for='logo'>Selecione uma imagem</label>
			</div>
			<input type="submit" value='Enviar'>
		</form>
<?php
		}
	}
?>
</body>
</html>