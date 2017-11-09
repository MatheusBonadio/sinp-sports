<?php
	require_once '../../dao/EquipeDAO.php';
	$dao = new EquipeDAO();
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_equipe']."<br>";
		echo "Nome: ".$listar['nome']."<br>";
		echo "Vitorias: ".$listar['vitorias']."<br>";
		echo "Empates: ".$listar['empates']."<br>";
		echo "Derrotas: ".$listar['derrotas']."<br>";
		echo "Pontos: ".$listar['pontos']."<br>";
		echo "<a href=formEquipe.php?id=".$listar['id_equipe'].">ALTERAR</a><br>";
		echo "<a href=deleteEquipe.php?id=".$listar['id_equipe'].">EXCLUIR</a><br>";
	}
?>