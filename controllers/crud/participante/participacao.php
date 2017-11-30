<?php
	session_start();
	
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

