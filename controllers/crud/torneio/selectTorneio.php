<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/TorneioDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new TorneioDAO();

	$exec = $dao->listar($_SESSION['torneio']);

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}
?>
	<div class='container_header flex'>Torneio</div>
	<div class='container_body'>
<?php if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listarSituacaoTorneio();
	foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/sistema/torneio.png);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['descricao'] ?></div>
				<div class='info_data'>
					<?php echo $listar['inicio'] ?><br />
					<?php echo $listar['termino'] ?><br />
					<?php echo $listar['situacao'] ?><br />
				</div>
				<div class='buttons'>
					<a href=formTorneio.php?id=<?php echo $listar['id_torneio']?>>Alterar</a>
					<a href=deleteTorneio.php?id=<?php echo $listar['id_torneio']?> class='delete'>Excluir</a>
				</div>
			</div>
		</div>
	<?php }
?>
	<a class='insert material-icons flex' href='formTorneio.php'>add</a>
	</div>
<?php
}
?>