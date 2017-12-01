<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ParticipanteDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new ParticipanteDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Gerente'){
		$exec = $dao->listar($_SESSION['torneio']);
	}

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Participante</div>
	<div class='container_body'>
<?php foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/sistema/user.png);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['nome'] ?></div>
				<div class='info_data'>
					<?php echo $listar['nome_equipe'] ?><br />
				</div>
				<div class='buttons'>
					<a href=formParticipante.php?id=<?php echo $listar['id_participante']?>>Alterar</a>
					<a href=deleteParticipante.php?id=<?php echo $listar['id_participante']?> class='delete'>Excluir</a>
				</div>
			</div>
		</div>
	<?php } ?>
	<a class='insert material-icons flex' href='formParticipante.php'>add</a>
	<!-- <a href="participacao.php">PARTICIPACAO</a><br> -->
	</div>