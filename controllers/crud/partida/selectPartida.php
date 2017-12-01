<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new PartidaDAO();
	$daoAdm = new AdministradorDAO();
	

	$i = 0;	
	foreach($_SESSION['permissao'] as $value){
  		 foreach($value as $v_key){
        	$idEsporte[$i] = $v_key;
        	$i++;
   		}
	}

	$numPermissao = $daoAdm->consultarNumPermissao($_SESSION['login']);

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

?>
	<div class='container_header flex'>Partida</div>
	<div class='container_body'>
<?php if($_SESSION['cargo'] == 'Administrador'){

	for ($i=0; $i < $numPermissao; $i++) { 
		$exec = $dao->listarEsporte($idEsporte[$i], $_SESSION['torneio']);

		foreach ($exec as $listar) {?>
			<div class='block'>
				<div class='img' style='background-image: url(/public/img/sistema/torneio.png);'></div>
				<div class='info'>
					<div class='info_name'><?php echo $listar['nome_equipe_a']." x ".$listar['nome_equipe_b'] ?></div>
					<div class='info_data'>
						<?php echo $listar['id_esporte'] ?><br />
						<?php echo $listar['id_fase'] ?><br />
						<?php echo $listar['dia'] ?><br />
						Inicio: <?php echo $listar['inicio'] ?><br />
						Término: <?php echo $listar['inicio'] ?><br />
						Placar: <?php echo $listar['placar_equipe_a']." x ".$listar['placar_equipe_b'] ?><br />
						Vencedor: <?php echo $listar['vencedor'] ?><br />
					</div>
					<div class='buttons'>
						<a href=formPontuacao.php?id=<?php echo $listar['id_partida']?>>Score</a>
					</div>
				</div>
			</div>
		<?php }
	}
}

if($_SESSION['cargo'] == 'Gerente'){
		$exec = $dao->listar($_SESSION['torneio']);

		foreach ($exec as $listar) {?>
			<div class='block'>
				<div class='img' style='background-image: url(/public/img/sistema/torneio.png);'></div>
				<div class='info'>
					<div class='info_name'><?php echo $listar['nome_equipe_a']." x ".$listar['nome_equipe_b'] ?></div>
					<div class='info_data'>
						<?php echo $listar['id_esporte'] ?><br />
						<?php echo $listar['id_fase'] ?><br />
						<?php echo $listar['dia'] ?><br />
						Inicio: <?php echo $listar['inicio'] ?><br />
						Término: <?php echo $listar['inicio'] ?><br />
						Placar: <?php echo $listar['placar_equipe_a']." x ".$listar['placar_equipe_b'] ?><br />
						Vencedor: <?php echo $listar['vencedor'] ?><br />
					</div>
					<div class='buttons'>
						<a href=formPartida.php?id=<?php echo $listar['id_partida']?>>Alterar</a>
						<a href=deletePartida.php?id=<?php echo $listar['id_partida']?>>Excluir</a>
					</div>
				</div>
			</div>
		<?php } ?>
	<a class='insert material-icons flex' href='formPartida.php'>add</a>
	<?php
	}
	?>
	</div>