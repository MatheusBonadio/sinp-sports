<?php
	require_once '../../dao/DestaqueDAO.php';
	$dao = new DestaqueDAO();
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_destaque']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Partida: ".$listar['id_partida']."<br>";
		echo "Texto: ".$listar['texto']."<br>";
		echo "Imagem: ".$listar['imagem']."<br>";
		echo "<a href=formDestaque.php?id=".$listar['id_destaque'].">ALTERAR</a><br>";
		echo "<a href=deleteDestaque.php?id=".$listar['id_destaque'].">EXCLUIR</a><br>";
	}
?>