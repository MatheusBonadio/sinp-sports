<?php
	require_once '../../dao/TorneioDAO.php';
	$dao = new TorneioDAO();
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