
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

	$exec = $dao->consultarEsporteID($_SESSION['torneio'], $_GET['idEsporte']);
	
?>
<form action='insertParticipacao.php' method="POST">
<?php
	
	foreach ($exec as $listar) {
		
		$qtdJogadores = $dao->consultarQtdJogadores($_SESSION['torneio'], $listar['id_esporte']);
		$qtdTimes = $dao->consultarQtdTimes($_SESSION['torneio'], $listar['id_esporte']);
		for ($j=0; $j < $qtdTimes; $j++) { 
			echo $listar['esporte'];
		for ($i=0; $i < $qtdJogadores; $i++) { 
?>
	<input type="text" name="esporte" value="<?php echo $listar['id_esporte']; ?>" hidden>
	<select name="participacao[]">
		<option selected disabled hidden>Selecione um participante</option>
		<?php
			$execPartic = $dao->listar($_SESSION['torneio']);
			foreach ($execPartic as $listarPartic) {
		?>
		<option value="<?php echo $listarPartic['id_participante']?>"><?php echo $listarPartic['nome']?></option>
		<?php 
			} 
		?>
	</select><br>
<?php
	}
	}
}
?>
	<input type="submit">
</form>

