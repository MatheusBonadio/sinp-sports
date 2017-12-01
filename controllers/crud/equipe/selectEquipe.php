<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EquipeDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new EquipeDAO();	
	

	if($_SESSION['cargo'] == 'Representante'){
		$exec = $dao->listarEquipeRepre($_SESSION['login'], $_SESSION['torneio']);
	}else if($_SESSION['cargo'] == 'Gerente' || $_SESSION['cargo'] == 'Administrador'){
		$exec = $dao->listar($_SESSION['torneio']);
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Equipe</div>
	<div class='container_body'>
<?php foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/equipe/<?php echo $listar['logo'] ?>);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['nome']." (".$listar['sigla'].")" ?></div>
				<div class='info_data'>
					Ouro: <?php echo $listar['ouro'] ?><br />
					Prata: <?php echo $listar['prata'] ?><br />
					Bronze: <?php echo $listar['bronze'] ?><br />
					Pontos: <?php echo $listar['pontos'] ?><br />
					Representante: <?php echo $listar['representante'] ?><br />
				</div>
				<div class='buttons'>
					<?php if($_SESSION['cargo'] == 'Gerente' || $_SESSION['cargo'] == 'Representante'){ ?>
						<a href=formEquipe.php?id=<?php echo $listar['id_equipe']?>>Alterar</a>
					<?php } ?>
					<?php if($_SESSION['cargo'] == 'Gerente'){?>
						<a href=deleteEquipe.php?id=<?php echo $listar['id_equipe']?> class='delete'>Excluir</a>
				<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php if($_SESSION['cargo'] == 'Gerente'){ ?>		
		<a class='insert material-icons flex' href='formEquipe.php'>add</a>
	<?php } ?>