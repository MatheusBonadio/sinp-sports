<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Torneio.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/TorneioDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/calendario.html';
	$torneio = new Torneio();
	$dao = new TorneioDAO();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
	?>
	<div class='container_header flex'>Torneio</div>
	<div class='container_body'>
	<?php if(!isset($_GET['id'])){ ?>
	
		<form action="insertTorneio.php" method="POST">
			<input type="text" name="descricao" placeholder='Digite o nome do torneio' required>
			<input id="inicio" type="text" name="inicio" placeholder='Escolha a data de inicio' required>
			<input id="termino" type="text" name="termino" placeholder='Escolha a data de término' required>
			<input type="submit" value='Enviar'>
		</form>
	
<?php 
	}
	else{
		$id = $_GET['id'];
		$torneio = $dao->consultar($id);

 ?>
		<form action="updateTorneio.php" method="POST">
			<input type="text" name="id" value="<?php echo $torneio->getidTorneio(); ?>" hidden>
			<input type="text" name="descricao" value="<?php echo $torneio->getDescricao(); ?>" placeholder='Digite o nome do torneio' required>
			<input type="text" id="inicio" name="inicio" value="<?php echo $torneio->getInicio(); ?>" placeholder='Escolha a data de inicio' required>
			<input type="text" id="termino" name="termino" value="<?php echo $torneio->getTermino(); ?>" placeholder='Escolha a data de término' required>
			<input type="submit" value='Enviar'>
		</form>
<?php
	}
?>
</body>
</html>