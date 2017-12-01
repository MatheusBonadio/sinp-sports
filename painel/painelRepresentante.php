<?php
include($_SERVER['DOCUMENT_ROOT']."/painel/index.php");

$func = new Functions();
$func->sessionRepresentante();
?>
<body>
	<div class='header'>
		<div class='user'>
			<div>Bem vindo, </div>
			<div><?php echo $_SESSION['nome']; ?></div>
			<div><?php echo $_SESSION['cargo']; ?></div>
		</div>
		<a href="/controllers/crud/adm/trocarSenha.php">trocar senha</a>
		<a href="/controllers/crud/equipe/selectEquipe.php">equipe</a>
		<a href="/controllers/crud/participante/selectParticipante.php">participante</a>
		<a href="/controllers/session/sair.php">sair</a>
	</div>
	<div class='container'>