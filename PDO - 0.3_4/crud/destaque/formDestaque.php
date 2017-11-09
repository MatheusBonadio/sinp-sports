<html>
<body>
<?php
	require_once '../../class/Destaque.php';
	require_once '../../dao/DestaqueDAO.php';
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	if(!isset($_GET['id'])){
?>
		<form action="insertDestaque.php" enctype="multipart/form-data" method="POST">
			Partida<select name="partida">
				<?php
					$exec = $dao->consultarPartida();
					foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_partida']?>"><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
					}
				?>
			</select><br>
			texto	<textarea name="texto"></textarea><br>
			imagem<br><input type="file" name="imagem"><br>
			<input type="submit">
		</form>

<?php 
	}
	else{
		$id = $_GET['id'];
		$destaque = $dao->consultar($id);
 ?>

	<form action="updateDestaque.php" enctype="multipart/form-data" method="POST">
		id<input type="text" name="id" value="<?php echo $destaque->getidDestaque(); ?> "><br>
		Partida<select name="partida">
				<?php
					$exec = $dao->consultarPartida();
					foreach ($exec as $listar) {
						if($listar['id_partida'] == $destaque->getidPartida()){
				?>
							<option value="<?php echo $listar['id_partida']?>" selected><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
						}else{
				?>
					<option value="<?php echo $listar['id_partida']?>"><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
						}
					}
				?>
			</select><br>
		Texto<textarea name="texto"><?php echo $destaque->getTexto();?></textarea><br>
		imagem<br>
				<img src="../../img/destaque/<?php echo $destaque->getImagem(); ?>"><br>
 				<input type="file" name="imagem">
		<input type="submit">
		</form>

<?php

	}
?>
</body>
</html>