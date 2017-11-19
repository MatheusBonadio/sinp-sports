<html>
<body>
<?php
	require_once '../../class/Participante.php';
	require_once '../../dao/ParticipanteDAO.php';
	$participante = new Participante();
	$dao = new ParticipanteDAO();

	if(!isset($_GET['id'])){
?>

	<form action="insertParticipante.php" method="POST">
				nome<input type="text" name="nome"><br>
				torneio<select name='torneio'>
					<option selected disabled hidden>Selecione um torneio</option>
				<?php 
					$exec = $dao->consultarTorneio();
					foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
				<?php
					}
				?>
			</select><br>
				equipe<select name='equipe'>
						<option selected disabled hidden>Selecione uma equipe</option>
					<?php 
						$exec = $dao->consultarEquipe();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
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
		$participante = $dao->consultar($id);
		$exec = $dao->consultarParticipacao($participante->getidParticipante());
		foreach ($exec as $listar) {
			$arrayChecked[$listar['id_esporte']] = $listar['id_esporte'];
		}

 ?>

 	<form action="updateParticipante.php" method="POST">
 				id<input type="text" name="id" value='<?php echo $participante->getidParticipante();?>'><br>
				nome<input type="text" name="nome" value='<?php echo $participante->getNome();?>'><br>
				torneio<select name='torneio'>
				<?php 
					$exec = $dao->consultarTorneio();
					foreach ($exec as $listar) {
						if($listar['id_torneio'] == $participante->getidTorneio()){
				?>
							<option value="<?php echo $listar['id_torneio'];?>" selected><?php echo $listar['descricao']; ?></option>
				<?php
						}else{
				?>
							<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
				<?php
						}
					}
				?>
				</select><br>

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
				Selecao de esporte<br>
				<?php 
					$exec = $dao->consultarEsporte();
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<input type='checkbox' name='participacao[]' value='<?php echo $listar['id_esporte']; ?>' checked>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}else{
					?>
						<input type='checkbox' name='participacao[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					}
					?>

				<input type="submit">
	</form>
<?php
	}
?>
</body>
</html>