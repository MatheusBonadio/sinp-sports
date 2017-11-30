	<?php
		session_start();
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/EquipeDAO.php";
		$dao = new EquipeDAO();
		$exec = $dao->listar($_SESSION["torneio"]);
	?>
		<link rel="stylesheet" href="/public/css/equipes.css" type="text/css">
		<div class='container'>
			<div class='team'>
				<div class=''></div>
			</div>
		</div>
	<script>slider($(".header a:eq(4)"))</script>