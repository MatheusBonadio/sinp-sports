<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/dao/PartidaDAO.php";
	$dao = new PartidaDAO();
	$backup = 0;
	$arraySemana = Array(
		0=>"Domingo", 		1=>"Segunda-feira",	2=>"Terça-feira",	3=>"Quarta-feira",
		4=>"Quinta-feira",	5=>"Sexta-feira",	6=>"Sábado"
	);
	$arrayMes = Array(
		1=>"Janeiro",	2=>"Fevereiro",		3=>"Março",
		4=>"Abril",		5=>"Maio",			6=>"Junho",
		7=>"Julho",		8=>"Agosto",		9=>"Setembro",
		10=>"Outubro",	11=>"Novembro",		12=>"Dezembro"
	);
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		if($_GET['acao']=='esporte')
			$exec = $dao->listarEsporte($id, 1);
		else
			$exec = $dao->listarEquipe($id, 1);
	}else{
		$exec = $dao->listar(1);
	}
?>
	<div class='container_stage'>
<?php
	if(count($exec)>0){
	foreach ($exec as $listar) {
		if($listar['dia']!=$backup){
			$dia = substr($listar['dia'], -2);
			$mes = substr($listar['dia'], 5, 2);
		?>
		<a class='stage' href='#<?php echo $listar['dia'] ?>'><?php echo $dia."/".$mes ?></a>
		<?php 
			$backup = $listar['dia'];
		}
	}
	$backup = 0;
	?>
	</div>
	<div class='matchs'>
<?php 
	foreach ($exec as $listar) {
		if($listar['dia']!=$backup){
			$dia = substr($listar['dia'], -2);
			$mes = substr($listar['dia'], 5, 2);
			$ano = substr($listar['dia'], 0, 4);
			$dia_nome = $arraySemana[date("N", mktime(0, 0, 0, $mes, $dia, $ano))];
			$mes_nome = $arrayMes[$mes];
			$backup = $listar['dia'];
?>
			<div class='date' id='<?php echo $listar['dia'] ?>'><?php echo $dia_nome.", ".$dia." de ".$mes_nome." de ".$ano?></div>
			<?php 
				$backup = $listar['dia'];
			}
			?>
			<a class='match' href='partida?id=<?php echo $listar['id_partida']?>'>
				<div class='time flex'>
					<span><?php echo $listar['inicio'] ?>h</span>
					<span><?php echo $listar['id_esporte'] ?></span>
				</div>
				<div class='teams'>
					<div class='team_a'>
						<div class='team_name'>
							<span><?php echo $listar['nome_equipe_a'] ?></span>
							<span class='victory'></span>
						</div>
						<div class='team_img flex'>
							<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/hongkong-esports-40hnvdmn.png' width='90%'>
						</div>
					</div>
					<div class='versus flex'>VS</div>
					<div class='team_b'>
						<div class='team_img flex'>
							<img src='https://lolstatic-a.akamaihd.net/esports-assets/production/team/rampage-4caqgbq7.png' width='90%'>
						</div>
						<div class='team_name'>
							<span><?php echo $listar['nome_equipe_b'] ?></span>
							<span class='defeat'></span>
						</div>
					</div>
				</div>
			</a>
	<?php } }else echo "<div class='error flex'>Nenhuma partida encontrada</div>"; ?>
	</div>
	<script>
		var $doc = $('html, body');
		$('.stage').click(function() {
			console.log($( $.attr(this, 'href') ));
		    $doc.animate({
		        scrollTop: ($( $.attr(this, 'href') ).offset().top - 70)
		    }, 500);
		    return false;
		});
	</script>