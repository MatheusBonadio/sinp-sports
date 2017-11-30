
<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Fase.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/FaseDAO.php';
	$fase = new Fase();
	$dao = new FaseDAO();
	

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
 				<input type="text" name="id" value='<?php echo $fase->getidFase();?>' hidden>
				descricao<input type="text" name="descricao" value='<?php echo $fase->getDescricao();?>'><br>
				indice<input type="text" name="indice" value='<?php echo $fase->getIndice();?>'><br>
				<input type="submit">
	</form>
<?php
	}
?>
</body>
</html>