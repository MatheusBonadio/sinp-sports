
<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Esporte.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/esporte/Functions.php';
	$esporte = new Esporte();
	$dao = new EsporteDAO();
	$func = new FunctionsEsporte();

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}
?>
	<div class='container_header flex'>Esporte</div>
	<div class='container_body'>
	<?php if(!isset($_GET['id'])){ ?>
		<form action="insertEsporte.php" enctype="multipart/form-data" method="POST">
			<input type="text" name="esporte" placeholder='Digite o nome do esporte' required>
			<select name="genero" required>
				<?php $func->optionsGenero($esporte); ?>
			</select>
			<select name="tipo">
				<?php $func->optionsTipo($esporte); ?>
			</select>
			<input type="number" name="qtdJogadores" placeholder='Digite a quantidade de jogadores por time' required>
			<input type="number" name="qtdTimes" placeholder='Digite a quantidade de times por equipe' required>
			<select name="classificacao">
				<?php $func->optionsClassificacao($esporte); ?>
			</select><br>
			<div class='container_img'>
				<input type="file" name="imagem" id='imagem' accept="image/*" hidden>
				<label for='imagem'>Selecione uma imagem</label>
			</div>
			<input type="submit" value='Enviar'>
		</form>

<?php 
	}
	else{
		$id = $_GET['id'];
		$esporte = $dao->consultar($id);
 ?>

	<form action="updateEsporte.php" enctype="multipart/form-data" method="POST">
		<input type="text" name="id" value="<?php echo $esporte->getidEsporte(); ?>" hidden>
		<input type="text" name="esporte" value="<?php echo $esporte->getEsporte(); ?>" placeholder='Digite o nome do esporte' required>
		<select name="genero">
			<?php $func->optionsGenero($esporte); ?>
		</select>
		<select name="tipo">
			<?php $func->optionsTipo($esporte); ?>
		</select>
		<input type="number" name="qtdJogadores" value="<?php echo $esporte->getqtdJogadores(); ?>" placeholder='Digite a quantidade de jogadores por time' required>
		<input type="number" name="qtdTimes" value="<?php echo $esporte->getqtdTimes(); ?>" placeholder='Digite a quantidade de times por equipe' required>
		<select name="classificacao">
			<?php $func->optionsClassificacao($esporte); ?>
		</select>
		<div class='container_img'>
			<div class='select_img' style='background-image: url(/public/img/esporte/<?php echo $esporte->getImagem(); ?>)'></div>
			<input type="file" name="imagem" id='imagem' accept="image/*" hidden>
			<label for='imagem'>Selecione uma imagem</label>
		</div>
		<input type="submit" value='Enviar'>
		</form>

<?php
	}
?>
	</div>
</body>
</html>