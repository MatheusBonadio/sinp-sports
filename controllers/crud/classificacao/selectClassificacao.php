<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ClassificacaoDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new ClassificacaoDAO();
	

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Classificação</div>
	<div class='container_body'>
<?php $exec = $dao->listar($_SESSION['torneio']);
	foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/sistema/fase.png);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['nomeEsporte'] ?></div>
				<div class='info_data'>
					<?php echo $listar['nomeEquipe'] ?><br />
					Pontos: <?php echo $listar['pontuacao'] ?><br />
				</div>
				<div class='buttons'>
					<?php if($_SESSION['cargo'] == 'Gerente'){ ?>
					<a href=deleteClassificacao.php?id=<?php echo $listar['id_classificacao']?> class='delete'>Excluir</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }
?>
</div>
<a class='insert material-icons flex' href='insertClassificacao.php'>add</a>
</div>