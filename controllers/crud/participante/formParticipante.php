<html>
<body>
<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_GET['id'])){
		if($_SESSION['cargo'] == 'Gerente'){
?>

	<form action="insertParticipante.php" method="POST">
				nome<input type="text" name="nome"><br>
				equipe<select name='equipe'>
						<option selected disabled hidden>Selecione uma equipe</option>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select><br>
				<input type="submit">
				<a href="selectParticipante.php">Finalizar</a>
	</form>
<?php 
	}if($_SESSION['cargo'] == 'Representante'){
		$idEquipe = $dao->consultarEquipeRepre($_SESSION['login'], $_SESSION['torneio']);
?>
	<form action="insertParticipante.php" method="POST">
				nome<input type="text" name="nome"><br>
				<input type="text" name="equipe" value="<?php echo $idEquipe; ?>" hidden>
				<input type="submit">
				<a href="selectParticipante.php">Finalizar</a>
<?php
	}
	}else{
		$id = $_GET['id'];
		$participante = $dao->consultar($id);
		$exec = $dao->consultarParticipacao($participante->getidParticipante());
		foreach ($exec as $listar) {
			$arrayChecked[$listar['id_esporte']] = $listar['id_esporte'];
		}

	if($_SESSION['cargo'] == 'Gerente'){
 ?>

 	<form action="updateParticipante.php" method="POST">
 				<input type="text" name="id" value='<?php echo $participante->getidParticipante();?>' hidden>
				nome<input type="text" name="nome" value='<?php echo $participante->getNome();?>'><br>
				equipe<select name='equipe'>
					<?php 
						$exec = $dao->consultarEquipe();
						foreach ($exec as $listar) {
							if($listar['id_equipe'] == $participante->getidEquipe()){
					?>
								<option value="<?php echo $listar['id_equipe'];?>" selected><?php echo $listar['nome']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
							}
						}
					?>
					</select><br>
				Selecao de esporte: <br>
				<?php 
					$exec = $dao->consultarEsporte($_SESSION['torneio']);
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>' checked>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}else{
					?>
						<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					}
					?>

				<input type="submit">
	</form>
<?php
		}

	if($_SESSION['cargo'] == 'Representante'){
?>
	<form action="updateParticipante.php" method="POST">
 				<input type="text" name="id" value='<?php echo $participante->getidParticipante();?>' hidden>
				nome<input type="text" name="nome" value='<?php echo $participante->getNome();?>'><br>
				<input type="text" name="equipe" value="<?php echo $participante->getidEquipe(); ?>" hidden>
				Selecao de esporte: <br>
				<?php 
					$exec = $dao->consultarEsporte($_SESSION['torneio']);
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>' checked>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}else{
					?>
						<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>'>
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
?>
</body>
</html>