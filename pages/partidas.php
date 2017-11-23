	<link rel="stylesheet" href="/public/css/partidas.css" type="text/css">
	<?php
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/PartidaDAO.php";
		$dao = new PartidaDAO();
		$exec = $dao->listarEsportePartida();
	?>
	<div class='container'>
		<div class='container_filter'>
			<div class='filter_header'>FILTROS</div>
			<div class='filter_header'>ESPORTES</div>
			<div class='filter_line'></div>
			<div class='filter' onclick='select_filter()'>Todos</div>
			<?php foreach ($exec as $listar) { ?>
			<div class='filter' onclick='select_filter(<?php echo $listar['id_esporte']?>, "esporte")'><?php echo $listar['esporte']?></div>
			<?php 
			}
			$exec = $dao->listarEquipePartida();
			?>
			<div class='filter_header'>EQUIPES</div>
			<div class='filter_line'></div>
			<?php foreach ($exec as $listar) { ?>
			<div class='filter' onclick='select_filter(<?php echo $listar['id_equipe_a']?>, "equipe")'><?php echo $listar['nome']?></div>
			<?php } ?>
		</div>
		<div class='container_match'>
			<div class='load flex'>
				<div class='loader'></div>
				<label>Loading</label>
			</div>
			<div class='content_match'>
				<?php 
					$url = $_SERVER['DOCUMENT_ROOT']."/controllers/crud/partida/filterPartida.php";
					require_once($url); 
				?>
			</div>
		</div>
	</div>
	<script src="/public/js/partidas.js"></script>
	<script>$('.load').hide();</script>
	<script>slider($(".header a:eq(2)"))</script>