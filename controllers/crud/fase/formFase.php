<html>
<body>
<?php
	require_once '../../class/Fase.php';
	require_once '../../dao/FaseDAO.php';
	$fase = new Fase();
	$dao = new FaseDAO();

	if(!isset($_GET['id'])){
?>

	<form action="insertFase.php" method="POST">
				descricao<input type="text" name="descricao"><br>
				indice<input type="text" name="indice"><br>
				<input type="submit">
	</form>
<?php 
	}
	else{
		$id = $_GET['id'];
		$fase = $dao->consultar($id);

 ?>

 	<form action="updateFase.php" method="POST">
 				id<input type="text" name="id" value='<?php echo $fase->getidFase();?>'><br>
				descricao<input type="text" name="descricao" value='<?php echo $fase->getDescricao();?>'><br>
				indice<input type="text" name="indice" value='<?php echo $fase->getIndice();?>'><br>
				<input type="submit">
	</form>
<?php
	}
?>
</body>
</html>