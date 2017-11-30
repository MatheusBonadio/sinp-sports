<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/session/Functions.php";

$func = new Functions();
session_start();
$func->sessionAdm();	

?>
<html>
	<a href="..\controllers\crud\adm\trocarSenha.php">TROCAR SENHA</a><br>
	<a href="..\controllers\crud\partida\selectPartida.php">PARTIDA</a><br>
	<a href="..\controllers\crud\destaque\selectDestaque.php">DESTAQUE</a><br>
	<a href="..\controllers\crud\classificacao\selectClassificacao.php">CLASSIFICACAO</a><br>
	<a href="..\controllers\crud\equipe\selectEquipe.php">EQUIPE</a><br>
	<a href="..\controllers\session\sair.php">Sair</a>
</html>