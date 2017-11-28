<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/EsporteDAO.php";
	$dao = new EsporteDAO();
	$exec = $dao->listar();
	$backupTipo = "";
	error_reporting(0);
?>
	<link rel="stylesheet" href="/public/css/esportes.css" type="text/css">
	<div class='container'>
	<?php foreach ($exec as $key => $listar) {
		$proximo = $exec[$key+1]["tipo"];
		if($listar["tipo"] != $backupTipo){
	?>
		<div class='sport_type flex'>
			<div class='sport_type_line'></div>
			<label><?php echo $listar["tipo"] ?></label>
			<div class='sport_type_line'></div>
		</div>
		<div class='sport_container'>
	<?php }?>
			<div class='sport' style='background-image: url(/public/img/esporte/<?php echo $listar["imagem"] ?>);'>
				<div class='sport_read'>
					<div class='flex'><?php echo $listar["esporte"]?></div>
					<div class='flex'><?php echo $listar["classificacao"] ?> – <?php echo $listar["qtd_jogadores"] ?> jogador(es)</div>
				</div>
			</div>
	<?php if($listar["tipo"] == $backupTipo && $listar["tipo"] != $proximo){?>
		</div>
	<?php
	}
	$backupTipo = $listar["tipo"];
	} ?>
	</div>
	<!--<script src="/public/js/partidas.js"></script> -->
	<!-- <script>$('.load').hide();</script> -->
	<script>slider($(".header a:eq(3)"))</script>