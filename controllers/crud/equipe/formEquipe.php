<?php
	session_start();

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


	if(!isset($_GET['id']) && $_SESSION['cargo'] != 'Representante'){
?>
<html>
<body>
		<form action="insertEquipe.php" method="POST" enctype="multipart/form-data">
			nome<input type="text" name="nome"><br>
			sigla<input type="text" name="sigla" maxlength="6" style='text-transform: uppercase;'><br>
			representante: <select name="representante">
				<?php
					$exec = $dao->consultarRepresentantes($_SESSION['torneio']);
					foreach ($exec as $listar) {				
				?>
					<option value="<?php echo $listar['login'];?>"><?php echo $listar['nome']; ?></option>
				<?php
					}
				?>
			</select><br>
			<input type="submit">
		</form>
	
<?php 
	}
	else{
		$id = $_GET['id'];
		$equipe = $dao->consultar($id, $_SESSION['torneio']);
		if($_SESSION['cargo'] == 'Representante'){
 ?>
		<form action="updateEquipe.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="id" value="<?php echo $equipe->getidEquipe(); ?>" hidden><br>
			nome<input type="text" name="nome" value="<?php echo $equipe->getNome(); ?>"><br>
			sigla<input type="text" name="sigla" value="<?php echo $equipe->getSigla(); ?>"><br>
			representante: <label><?php echo $_SESSION['login']; ?></label><br>
			<img src="/public/img/equipe/<?php echo $equipe->getLogo(); ?>">
			Logo<br><input type="file" name="logo"><br>
			<input type="submit">
		</form>
<?php
		}else if($_SESSION['cargo'] == 'Gerente'){
?>
		<form action="updateEquipe.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="id" value="<?php echo $equipe->getidEquipe(); ?>" hidden>
			nome<input type="text" name="nome" value="<?php echo $equipe->getNome(); ?>"><br>
			sigla<input type="text" name="sigla" value="<?php echo $equipe->getSigla(); ?>"><br>
			Representante: <select name='representante'>
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
					</select><br>
			<img src="/public/img/equipe/<?php echo $equipe->getLogo(); ?>">
			Logo<br><input type="file" name="logo"><br>
			<input type="submit">
		</form>
<?php
		}
	}
?>
</body>
</html>