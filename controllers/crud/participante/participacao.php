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

	$exec = $dao->consultarEsporte($_SESSION['torneio']);

	foreach ($exec as $listar) {
		//$registros = $dao->consultarRegistrosEsporte($_SESSION['torneio'], $listar['id_esporte']);
		//if (!$registros) {
?>
	<a href="formParticipacao.php?idEsporte=<?php echo $listar['id_esporte']; ?>"><?php echo $listar['esporte']; ?></a><br>
<?php
		//}
	}
?>

