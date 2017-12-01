<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/PartidaDAO.php";
	$dao = new PartidaDAO();
	
	$backup = 0;
	$arraySemana = Array(
		1=>"Segunda-feira",	2=>"Terça-feira",	3=>"Quarta-feira", 4=>"Quinta-feira",
		5=>"Sexta-feira",	6=>"Sábado", 		7=>"Domingo"
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
			$exec = $dao->listarEsporte($id, $_SESSION['torneio']);
		else
			$exec = $dao->listarEquipe($id, $_SESSION['torneio']);
	}else{
		$exec = $dao->listar($_SESSION['torneio']);
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
		if($listar['dia']!=$backup){
			$dia = substr($listar['dia'], -2);
			$mes = substr($listar['dia'], 6, 1);
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
			<a class='match' onclick='select_match("<?php echo $_SESSION['descricao']?>", <?php echo $listar['id_partida']?>)'>
				<div class='time flex'>
					<span><?php echo $listar['inicio'] ?>h</span>
					<span><?php echo $listar['id_esporte'] ?></span>
				</div>
				<div class='teams'>
					<div class='team_a'>
						<div class='team_name'>
							<span><?php echo $listar['sigla_a'] ?></span>
							<span><?php echo $listar['nome_equipe_a'] ?></span>
							<span class='<?php echo $listar['equipe_a'] ?>'><?php echo $listar['equipe_a'] ?></span>
						</div>
						<div class='team_img flex'>
							<img src='/public/img/equipe/<?php echo $listar['logo_a'] ?>' width='90%'>
						</div>
					</div>
					<div class='versus flex'>VS</div>
					<div class='team_b'>
						<div class='team_img flex'>
							<img src='/public/img/equipe/<?php echo $listar['logo_b'] ?>' width='90%'>
						</div>
						<div class='team_name'>
							<span><?php echo $listar['sigla_b'] ?></span>
							<span><?php echo $listar['nome_equipe_b'] ?></span>
							<span class='<?php echo $listar['equipe_b'] ?>'><?php echo $listar['equipe_b'] ?></span>
						</div>
					</div>
				</div>
			</a>
	<?php } }else echo "<div class='error flex'>Nenhuma partida encontrada</div>"; ?>
	</div>
	<script>
		$('.stage').click(function() {
			console.log($( $.attr(this, 'href') ));
		    $('html, body').animate({
		        scrollTop: ($( $.attr(this, 'href') ).offset().top - 70)
		    }, 500);
		    return false;
		});
	</script>