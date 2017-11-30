
<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Destaque.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/DestaqueDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$daoAdm = new AdministradorDAO();
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /errors/403');
	}
	
	$i = 0;	
		foreach($_SESSION['permissao'] as $value){
	  		 foreach($value as $v_key){
	        	$idEsporte[$i] = $v_key;
	        	$i++;
	   }
	}

	$numPermissao = $daoAdm->consultarNumPermissao($_SESSION['login']);

	

if($_SESSION['cargo'] == 'Administrador' || $_SESSION['cargo'] == 'Gerente'){

	if(!isset($_GET['id'])){
?>
<html>
<body>
		<form action="insertDestaque.php" enctype="multipart/form-data" method="POST">
			Partida<select name="partida">
				<?php
				for ($i=0; $i < $numPermissao; $i++) { 
					$exec = $dao->consultarPartida($idEsporte[$i], $_SESSION['torneio']);
					foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_partida']?>"><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
					}
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
		<input type="text" name="id" value="<?php echo $destaque->getidDestaque(); ?> " hidden>
		Partida<select name="partida">
				<?php
				for ($i=0; $i < $numPermissao; $i++) { 
					$exec = $dao->consultarPartida($idEsporte[$i], $_SESSION['torneio']);
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
				}
				?>
			</select><br>
		Texto<textarea name="texto"><?php echo $destaque->getTexto();?></textarea><br>
		imagem<br>
				<img src="/public/img/destaque/<?php echo $destaque->getImagem(); ?>"><br>
 				<input type="file" name="imagem">
		<input type="submit">
		</form>

<?php
	}
}else{
	header('location: /error/403');
}
?>
</body>
</html>