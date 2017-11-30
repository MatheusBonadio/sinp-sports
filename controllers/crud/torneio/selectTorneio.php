<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/TorneioDAO.php';
	$dao = new TorneioDAO();
	

	$exec = $dao->listar($_SESSION['torneio']);

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_torneio']."<br>";
		echo "Descricao: ".$listar['descricao']."<br>";
		echo "Inicio: ".$listar['inicio']."<br>";
		echo "Termino: ".$listar['termino']."<br>";
		echo "<a href=formTorneio.php?id=".$listar['id_torneio'].">ALTERAR</a><br>";
		echo "<a href=deleteTorneio.php?id=".$listar['id_torneio'].">EXCLUIR</a><br>";
	}
?>
<a href="formTorneio.php">INSERIR</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>
<?php
}
?>