	<?php
	
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/session/Functions.php";

	$func = new Functions();
	$func->sessionAdm();	
	
	?>
<html>
	<a href="..\controllers\crud\partida\selectPartida.php">PARTIDA</a><br>
	<a href="..\controllers\crud\destaque\selectDestaque.php">DESTAQUE</a><br>
	<a href="..\controllers\session\sair.php">Sair</a>
</html>