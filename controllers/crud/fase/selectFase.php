<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/FaseDAO.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$dao = new FaseDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Fase</div>
	<div class='container_body'>
<?php if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar();
	foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/sistema/fase.png);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['fase_descricao'] ?></div>
				<div class='info_data'>
					<?php echo $listar['fase_indice'] ?><br />
				</div>
				<div class='buttons'>
					<a href=formFase.php?id=<?php echo $listar['id_fase']?>>Alterar</a>
					<a href=deleteFase.php?id=<?php echo $listar['id_fase']?> class='delete'>Excluir</a>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<a class='insert material-icons flex' href='formFase.php'>add</a>
<?php
}
?>