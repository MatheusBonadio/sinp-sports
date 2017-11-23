<html>
	<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/session/Functions.php";

	$func = new Functions();
	$func->sessionRepresentante();
	
	?>
	<a href="..\controllers\crud\equipe\selectEquipe.php">EQUIPE</a><br>
	<a href="..\controllers\session\sair.php">Sair</a>
</html>