<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Participante.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();
	

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Participante</div>
	<div class='container_body'>
	<?php if(!isset($_GET['id'])){
		if($_SESSION['cargo'] == 'Gerente'){
?>
	<form action="insertParticipante.php" method="POST">
				<input type="text" name="nome" placeholder="Digite o nome do participante" required>
				<select name='equipe' required>
						<option selected disabled hidden value=''>Selecione uma equipe</option>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select>
				<input type="submit" value='Enviar'>
				<a class='finish flex' href="selectParticipante.php" >Finalizar</a>
	</form>
<?php 
	}if($_SESSION['cargo'] == 'Representante'){
		$idEquipe = $dao->consultarEquipeRepre($_SESSION['login'], $_SESSION['torneio']);
?>
	<form action="insertParticipante.php" method="POST">
				<input type="text" name="nome" placeholder="Digite o nome do participante" required>
				<input type="text" name="equipe" value="<?php echo $idEquipe; ?>" hidden>
				<input type="submit" value='Enviar'>
				<a class='finish flex' href="selectParticipante.php">Finalizar</a>
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
				<input type="text" name="nome" value='<?php echo $participante->getNome();?>' placeholder="Digite o nome do participante" required>
				<select name='equipe' required>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
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
					</select>
				<div class='container_checkbox'>
				<?php 
					$exec = $dao->consultarEsporte($_SESSION['torneio']);
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<div class='group_check'>
							<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>' checked>
							<label><?php echo $listar['esporte']; ?></label>
						</div>
					<?php
						}else{
					?>	<div class='group_check'>
							<input type='checkbox' name='idEsporte[]' value='<?php echo $listar['id_esporte']; ?>'>
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

	if($_SESSION['cargo'] == 'Representante'){
?>
	<form action="updateParticipante.php" method="POST">
 				<input type="text" name="id" value='<?php echo $participante->getidParticipante();?>' hidden>
				<input type="text" name="nome" value='<?php echo $participante->getNome();?>'  placeholder="Digite o nome do participante" required>
				<input type="text" name="equipe" value="<?php echo $participante->getidEquipe(); ?>" hidden>
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

				<input type="submit" value='Enviar'>
	</form>	
<?php

	}
	}
?>
</body>
</html>