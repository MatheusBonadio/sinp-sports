	<link rel="stylesheet" href="/public/css/home.css" type="text/css">

	<?php
		session_start();
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/DestaqueDAO.php";
		$dao = new DestaqueDAO();
		$exec = $dao->listar($_SESSION['torneio']);
	?>
	<div class='slideshow'>
		<div class='highlight_container'>
	<?php
				foreach ($exec as $listar) {
	?>
			<div class='highlight_img' style='background-image: linear-gradient(to bottom, rgba(20,20,20,.45) 0%,rgba(20,20,20,.45) 100%), url(/public/img/destaque/<?php echo $listar['imagem'] ?>);'>
				<div class='shadow'></div>
				<div class='highlight_position'>
					<div class='highlight_date'>
						<?php echo $listar['dia']." - ".$listar['tipo']; ?>
					</div>
					<div class='highlight_sport'><?php echo $listar['esporte']; ?></div>
					<div class='highlight_line'></div>
					<div class='highlight_text'>
						<?php echo $listar['texto']; ?>
					</div>
				</div>
			</div>
	<?php
			}
	?>
		</div>
		<div class='container_dots flex'>
			<div class='dots_line'></div>
			<div class='group_dots'></div>
			<div class='dots_line'></div>
		</div>
		<div class='arrow flex material-icons' onclick='plusSlides(1)'>keyboard_arrow_right</div>
		<div class='arrow flex material-icons' onclick='plusSlides(-1)'>keyboard_arrow_left</div>
	</div>
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/PartidaDAO.php";
		$dao = new PartidaDAO();
		$exec = $dao->listarPartidasFinalizadas($_SESSION['torneio']);
	?>
	<div class='next_games'>
		<?php foreach ($exec as $listar) {
			if($listar['nome_equipe_a'] == $listar['vencedor']){
				$listar['equipe_a'] = "V";
				$listar['equipe_b'] = "D";
			}else if($listar['nome_equipe_b'] == $listar['vencedor']){
				$listar['equipe_a'] = "D";
				$listar['equipe_b'] = "V";
			}
		?>
		<div class='match flex' onclick='select_match("<?php echo $_SESSION['descricao']?>", <?php echo $listar['id_partida']?>)'>
			<div class='sport'><?php echo $listar['id_esporte'] ?></div>
			<div class='team flex'>
				<img src='/public/img/equipe/<?php echo $listar['logo_a'] ?>' width='16%'/>
				<label><?php echo $listar['sigla_a'] ?></label>
				<label><?php echo $listar['equipe_a'] ?></label>
			</div>
			<div class='team flex'>
				<img src='/public/img/equipe/<?php echo $listar['logo_b'] ?>' width='16%'/>
				<label><?php echo $listar['sigla_b'] ?></label>
				<label><?php echo $listar['equipe_b'] ?></label>
			</div>
		</div>
		<?php }?>
	</div>
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/EquipeDAO.php";
		$dao = new EquipeDAO();
		$exec = $dao->listar($_SESSION['torneio']);
	?>
	<div class='table_classification flex'>
		<table>
			<thead>
				<tr>
					<th></th>
					<th>Posição</th>
					<th>Equipe</th>
					<th>Ouro</th>
					<th>Prata</th>
					<th>Bronze</th>
					<th>Pontos</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($exec as $key => $listar) {?>
				<tr>
					<td></td>
					<td><?php echo "#".($key+1) ?></td>
					<td><?php echo $listar['nome']; ?></td>
					<td><?php echo $listar['ouro']; ?></td>
					<td><?php echo $listar['prata']; ?></td>
					<td><?php echo $listar['bronze']; ?></td>
					<td><?php echo $listar['pontos']; ?></td>
					<td></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<script>
		$('#loader').hide();
		var slides = document.getElementsByClassName("highlight_img");
		for(i = 0; i < slides.length; i++){
			var HTMLString = "<div class='dots' onclick='currentSlide("+(i+1)+")'></div>";
			var ref = document.getElementsByClassName("group_dots")[0];
			var div = document.createElement('div');
			div.innerHTML = HTMLString;  
			ref.appendChild(div);
		}
	</script>
	<script src="/public/js/partidas.js"></script>
	<script src="/public/js/slideshow.js"></script>
	<script>slider($(".header a:eq(1)"))</script>