<?php
	require_once '../../dao/EsporteDAO.php';
	$dao = new EsporteDAO();
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_esporte']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Esporte: ".$listar['esporte']."<br>";
		echo "Genero: ".$listar['genero']."<br>";
		echo "Tipo: ".$listar['tipo']."<br>";
		echo "Qtd Jogadores: ".$listar['qtd_jogadores']."<br>";
		echo "Qtd Times: ".$listar['qtd_times']."<br>";
		echo "Classificacao: ".$listar['classificacao']."<br>";
		echo "Imagem: ".$listar['imagem']."<br>";
		echo "<a href=formEsporte.php?id=".$listar['id_esporte'].">ALTERAR</a><br>";
		echo "<a href=deleteEsporte.php?id=".$listar['id_esporte'].">EXCLUIR</a><br>";
	}
?>