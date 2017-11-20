<html>
<body>
<?php
	require_once '../../class/Esporte.php';
	require_once '../../dao/EsporteDAO.php';
	require_once 'Functions.php';
	$esporte = new Esporte();
	$dao = new EsporteDAO();
	$func = new Functions();

	if(!isset($_GET['id'])){
?>
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
			torneio<select name='torneio'>
					<option selected disabled hidden>Selecione um torneio</option>
				<?php 
					$exec = $dao->consultarTorneio();
					foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
				<?php
					}
				?>
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
		id<input type="text" name="id" value="<?php echo $esporte->getidEsporte(); ?> "><br>
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
		torneio<select name='torneio'>
				<?php 
					$exec = $dao->consultarTorneio();
					foreach ($exec as $listar) {
						if($listar['id_torneio'] == $esporte->getidTorneio()){
				?>
							<option value="<?php echo $listar['id_torneio'];?>" selected><?php echo $listar['descricao']; ?></option>
				<?php
						}else{
				?>
							<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
				<?php
						}
					}
				?>
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