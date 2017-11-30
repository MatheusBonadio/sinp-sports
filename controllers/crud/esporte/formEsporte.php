
<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Esporte.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/esporte/Functions.php';
	$esporte = new Esporte();
	$dao = new EsporteDAO();
	$func = new Functions();
	

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
		<form action="insertEsporte.php" enctype="multipart/form-data" method="POST">
			esporte<input type="text" name="esporte"><br>
			genero<select name="genero">
					<?php $func->optionsGenero($esporte); ?>
					</select><br>
			tipo<select name="tipo">
					<?php $func->optionsTipo($esporte); ?>
				</select><br>
			qtdJogadores<input type="text" name="qtdJogadores"><br>
			qtdTimes<input type="text" name="qtdTimes"><br>
			classificacao<select name="classificacao">
							<?php $func->optionsClassificacao($esporte); ?>
						</select><br>
			imagem<br><input type="file" name="imagem"><br>
			<input type="submit">
		</form>

<?php 
	}
	else{
		$id = $_GET['id'];
		$esporte = $dao->consultar($id);
 ?>

	<form action="updateEsporte.php" enctype="multipart/form-data" method="POST">
		<input type="text" name="id" value="<?php echo $esporte->getidEsporte(); ?> " hidden>
		esporte<input type="text" name="esporte" value="<?php echo $esporte->getEsporte(); ?> "><br>
		genero<select name="genero">
				<?php $func->optionsGenero($esporte); ?>
				</select><br>
		tipo<select name="tipo">
				<?php $func->optionsTipo($esporte); ?>
				</select><br>
		qtdJogadores<input type="text" name="qtdJogadores" value="<?php echo $esporte->getqtdJogadores(); ?> "><br>
		qtdTimes<input type="text" name="qtdTimes" value="<?php echo $esporte->getqtdTimes(); ?> "><br>
		classificacao<select name="classificacao">
				<?php $func->optionsClassificacao($esporte); ?>
				</select><br>
		imagem<br>
				<img src="../../../public/img/esporte/<?php echo $esporte->getImagem(); ?>">
 				<input type="file" name="imagem">
		<input type="submit">
		</form>

<?php
	}
?>
</body>
</html>