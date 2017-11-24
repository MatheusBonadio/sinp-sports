<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/TorneioDAO.php";
$dao = new TorneioDAO();
error_reporting(0);
$_SESSION['torneio'] = $_GET['torneio'];
$_SESSION['descricao'] = $dao->normalizaURL($_GET['descricao']);
if(isset($_SESSION['torneio'])){
	header("location: /".$dao->normalizaURL($_SESSION['descricao'])."/");
}
?>
<label>TORNEIOS:</label><br>
<?php
$exec = $dao->listar();
	foreach ($exec as $listar) {
?>
<a href="index.php?torneio=<?php echo $listar['id_torneio']; ?>&descricao=<?php echo $listar['descricao']; ?>"><?php echo $listar['descricao'].': Inicio: '.$listar['inicio'].' - Termino: '.$listar['termino'];?></a><br>
<?php } ?>