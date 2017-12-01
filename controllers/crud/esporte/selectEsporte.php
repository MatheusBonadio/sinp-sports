<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new EsporteDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Esporte</div>
	<div class='container_body'>

<?php if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar($_SESSION['torneio']);
	foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/esporte/<?php echo $listar['imagem'] ?>); background-size: cover'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['esporte'] ?></div>
				<div class='info_data'>
					<?php echo $listar['genero'] ?><br />
					<?php echo $listar['tipo'] ?><br />
					<?php echo $listar['qtd_jogadores'] ?> Jogadores<br />
					<?php echo $listar['qtd_times'] ?> Times<br />
					<?php echo $listar['classificacao'] ?><br />
				</div>
				<div class='buttons'>
					<a href=formEsporte.php?id=<?php echo $listar['id_esporte']?>>Alterar</a>
					<a href=deleteEsporte.php?id=<?php echo $listar['id_esporte']?> class='delete'>Excluir</a>
				</div>
			</div>
		</div>
<?php } ?>
	</div>
	<a class='insert material-icons flex' href='formEsporte.php'>add</a>
<?php
}
?>