<?php
	require_once '../../dao/FaseDAO.php';
	$dao = new FaseDAO();
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_fase']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Descricao: ".$listar['fase_descricao']."<br>";
		echo "Indice: ".$listar['fase_indice']."<br>";
		echo "<a href=formFase.php?id=".$listar['id_fase'].">ALTERAR</a><br>";
		echo "<a href=deleteFase.php?id=".$listar['id_fase'].">EXCLUIR</a><br>";
	}
?>