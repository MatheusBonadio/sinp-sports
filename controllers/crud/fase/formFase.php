
<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

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
?>
	<div class='container_header flex'>Fase</div>
	<div class='container_body'>
	<?php if(!isset($_GET['id'])){ ?>
	<form action="insertFase.php" method="POST">
		<input type="text" name="descricao" placeholder='Digite o nome da fase' required>
		<input type="number" name="indice" placeholder='Digite o índice da fase' required>
		<input type="submit" value='Enviar'>
	</form>
<?php 
	}
	else{
		$id = $_GET['id'];
		$fase = $dao->consultar($id);
 ?>

 	<form action="updateFase.php" method="POST">
		<input type="text" name="id" value='<?php echo $fase->getidFase();?>' hidden>
		<input type="text" name="descricao" value='<?php echo $fase->getDescricao();?>' placeholder='Digite o nome da fase' required>
		<input type="number" name="indice" value='<?php echo $fase->getIndice();?>' placeholder='Digite o índice da fase' required>
		<input type="submit" value='Enviar'>
	</form>
<?php
	}
?>
</body>
</html>