<?php
include($_SERVER['DOCUMENT_ROOT']."/painel/index.php");

$func = new Functions();
$func->sessionGerente();
?>
<body>
	<div class='header'>
		<div class='user'>
			<div>Bem vindo, </div>
			<div><?php echo $_SESSION['nome']; ?></div>
			<div><?php echo $_SESSION['cargo']; ?></div>
		</div>
		<a href="/controllers/crud/adm/selectAdm.php">administrador</a>
		<a href="/controllers/crud/torneio/selectTorneio.php">torneio</a>
		<a href="/controllers/crud/esporte/selectEsporte.php">esporte</a>
		<a href="/controllers/crud/fase/selectFase.php">fase</a>
		<a href="/controllers/crud/equipe/selectEquipe.php">equipe</a>
		<a href="/controllers/crud/participante/selectParticipante.php">participante</a>
		<a href="/controllers/crud/partida/selectPartida.php">partida</a>
		<a href="/controllers/crud/classificacao/selectClassificacao.php">classificação</a>
		<a href="/controllers/crud/destaque/selectDestaque.php">destaque</a>
		<a href="/controllers/session/sair.php">sair</a>
	</div>
	<div class='container'>