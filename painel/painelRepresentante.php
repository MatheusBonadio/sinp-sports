<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/session/Functions.php";

$func = new Functions();
session_start();
$func->sessionRepresentante();

?>
<html>
	<a href="..\controllers\crud\adm\trocarSenha.php">TROCAR SENHA</a><br>
	<a href="..\controllers\crud\equipe\selectEquipe.php">EQUIPE</a><br>
	<a href="..\controllers\crud\participante\selectParticipante.php">PARTICIPANTE</a><br>
	<a href="..\controllers\session\sair.php">Sair</a>
</html>