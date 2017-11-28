	<link rel="stylesheet" href="/public/css/partida.css" type="text/css">
	<?php
		session_start();
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/PartidaDAO.php";
		$dao = new PartidaDAO();
		$exec = $dao->listarID($_SESSION['torneio'], $_GET['id']);
		if(count($exec)>0){
		foreach ($exec as $listar) {
			$idEquipeA = $listar['id_equipe_a'];
			$idEquipeB = $listar['id_equipe_b'];
			$idEsporte = $listar['id_esporte'];
			if($listar['nome_equipe_a'] == $listar['vencedor']){
				$listar['equipe_a'] = "vitória";
				$listar['equipe_b'] = "derrota";
			}else if($listar['nome_equipe_b'] == $listar['vencedor']){
				$listar['equipe_a'] = "derrota";
				$listar['equipe_b'] = "vitória";
			}else{
				$listar['equipe_a'] = "";
				$listar['equipe_b'] = "";
			}
	?>
	<div class='match_header' style='background-image: linear-gradient(rgba(7,7,7,.85) 0%, rgba(7,7,7,.85) 100%), url(/public/img/esporte/<?php echo $listar['img_esporte'] ?>);'>
		<div class='match_sport'>
			<span><?php echo $listar['nome_esporte']?></span>
			<span>– <?php echo $listar['dia']?></span>
			<span><?php echo $listar['id_fase']?></span>
		</div>
		<div class='match_teams'>
			<div class='team_a'>
				<div class='team_name'>
					<span><?php echo $listar['nome_equipe_a']?></span>
					<span class='<?php echo $listar['equipe_a'] ?>'><?php echo $listar['equipe_a'] ?></span>
				</div>
				<div class='team_img flex' style='background-image: url(/public/img/equipe/<?php echo $listar['logo_a']; ?>)'></div>
			</div>
			<div class='versus flex'><?php echo $listar['placar_equipe_a']?> - <?php echo $listar['placar_equipe_b']?></div>
			<div class='team_b'>
				<div class='team_img flex' style='background-image: url(/public/img/equipe/<?php echo $listar['logo_b']; ?>)'></div>
				<div class='team_name'>
					<span><?php echo $listar['nome_equipe_b']?></span>
					<span class='<?php echo $listar['equipe_b'] ?>'><?php echo $listar['equipe_b'] ?></span>
				</div>
			</div>
		</div>
		<div class='container_participant'>
			<div class='participant_team_a'>
				<?php $exec2 = $dao->listarParticipanteEsporte($_SESSION['torneio'], $idEquipeA, $idEsporte);
				foreach ($exec2 as $listar2) {
					?><div><?php echo $listar2['nome']?></div>
				<?php }?>
			</div>
			<div class='participant_team_b'>
				<?php $exec2 = $dao->listarParticipanteEsporte($_SESSION['torneio'], $idEquipeB, $idEsporte);
				foreach ($exec2 as $listar2) {
					?><div><?php echo $listar2['nome']?></div>
				<?php }?>
			</div>
		</div>
	</div>
	<?php
	}
	}else
		echo "<script>window.location.href = '/".$_SESSION['descricao']."/partidas';</script>";
		//header("Location: /".$_SESSION['descricao']."/partidas");
	 ?>

	<script>$('#loader').hide();</script>
	<script>slider($(".header a:eq(2)"))</script>