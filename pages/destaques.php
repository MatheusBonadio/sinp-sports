<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/DestaqueDAO.php";
	$dao = new DestaqueDAO();
	$exec = $dao->listar($_SESSION["torneio"]);
	$backupTipo = "";
	//error_reporting(0);
?>
	<link rel="stylesheet" href="/public/css/esportes.css" type="text/css">
	<div class='container'>
		<div class='sport_type flex'>
			<div class='sport_type_line'></div>
			<label>League of Legends</label>
			<div class='sport_type_line'></div>
		</div>
		<div class='sport_container'>
			<div class='sport' style='background-image: url(/public/img/esporte/);'>
				<div class='sport_read'>
					<div class='flex'>Um projeto ambicioso</div>
					<div class='flex'>bandeirantes</div>
				</div>
			</div>
		</div>
	</div>
	<script>slider($(".header a:eq(4)"))</script>