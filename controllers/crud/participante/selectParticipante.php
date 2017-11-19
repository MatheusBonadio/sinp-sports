<?php
	require_once '../../dao/ParticipanteDAO.php';
	$dao = new ParticipanteDAO();
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_participante']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Nome: ".$listar['nome']."<br>";
		echo "Equipe: ".$listar['id_equipe']."<br>";
		echo "Participacao:<br>";
		$particExec = $dao->consultarParticipacao($listar['id_participante']);
		foreach ($particExec as $listarEsporte) {
			echo $listarEsporte['esporte']."<br>";
		}
		echo "<a href=formParticipante.php?id=".$listar['id_participante'].">ALTERAR</a><br>";
		echo "<a href=deleteParticipante.php?id=".$listar['id_participante'].">EXCLUIR</a><br>";
	}
?>