<?php
	session_start();
	
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

	if(!isset($_GET['id'])){
?>
<html>
<body>
	
		<form action="insertTorneio.php" method="POST">
			descricao<input type="text" name="descricao"><br>
			inicio<input id="inicio" type="text" name="inicio"><br>
			termino<input id="termino" type="text" name="termino"><br>
			<input type="submit">
		</form>
	
<?php 
	}
	else{
		$id = $_GET['id'];
		$torneio = $dao->consultar($id);

 ?>
		<form action="updateTorneio.php" method="POST">
			<input type="text" name="id" value="<?php echo $torneio->getidTorneio(); ?>" hidden>
			descricao<input type="text" name="descricao" value="<?php echo $torneio->getDescricao(); ?>"><br>
			inicio<input type="text" id="inicio" name="inicio" value="<?php echo $torneio->getInicio(); ?>"><br>
			termino<input type="text" id="termino" name="termino" value="<?php echo $torneio->getTermino(); ?>"><br>
			<input type="submit">
		</form>
<?php
	}
?>
</body>
</html>