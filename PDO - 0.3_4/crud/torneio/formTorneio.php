<html>
<body>
<?php
	require_once '../../class/Torneio.php';
	require_once '../../dao/TorneioDAO.php';
	require_once '../../crud/calendario.html';

	$torneio = new Torneio();
	$dao = new TorneioDAO();

	if(!isset($_GET['id'])){
?>
	
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
			id<input type="text" name="id" value="<?php echo $torneio->getidTorneio(); ?>"><br>
			descricao<input type="text" name="descricao" value="<?php echo $torneio->getDescricao(); ?>"><br>
			inicio<input type="text" name="inicio" value="<?php echo $torneio->getInicio(); ?>"><br>
			termino<input type="text" name="termino" value="<?php echo $torneio->getTermino(); ?>"><br>
			<input type="submit">
		</form>
<?php
	}
?>
</body>
</html>