<label>TORNEIOS:</label><br>
<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/TorneioDAO.php";
$dao = new TorneioDAO();
$exec = $dao->listar();
	foreach ($exec as $listar) {
?>
<a href="index.php?torneio=<?php echo $listar['id_torneio']; ?>"><?php echo $listar['descricao'].': Inicio: '.$listar['inicio'].' - Termino: '.$listar['termino'];?></a><br>
<?php
}
	session_start();
	$_SESSION['torneio'] = $_GET['torneio'];
	if(isset($_SESSION['torneio'])){
		header('location: /home');	
	}

	// crud/partida/
	// PartidaDAO
	// session/
	// painel/
	// AdministradorDAO
	// crud/adm/
	// Equipe.class
	// Participante.class
	// crud/participante
	// EquipeDAO
	// ParticipanteDAO
	
?>