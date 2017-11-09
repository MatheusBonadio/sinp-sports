<?php
	require_once '../../dao/PartidaDAO.php';
	$dao = new PartidaDAO();
	$exec = $dao->listar();

	
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_partida']."<br>";
		echo "EquipeA: ".$listar['id_equipe_a']."<br>";
		echo "EquipeB: ".$listar['id_equipe_b']."<br>";
		echo "Esporte: ".$listar['id_esporte']."<br>";
		echo "Fase: ".$listar['id_fase']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Dia: ".$listar['dia']."<br>";
		echo "Inicio: ".$listar['inicio']."<br>";
		echo "Termino: ".$listar['termino']."<br>";
		echo "PlacarA: ".$listar['placar_equipe_a']."<br>";
		echo "PlacarB: ".$listar['placar_equipe_b']."<br>";
		echo "Vencedor: ".$listar['vencedor']."<br>";
		echo "<a href=formPartida.php?id=".$listar['id_partida'].">ALTERAR</a><br>";
		echo "<a href=deletePartida.php?id=".$listar['id_partida'].">EXCLUIR</a><br>";
	}
?>