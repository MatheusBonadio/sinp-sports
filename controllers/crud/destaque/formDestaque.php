
<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

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

	
?>
	<div class='container_header flex'>Destaque</div>
	<div class='container_body'>
<?php if($_SESSION['cargo'] == 'Administrador' || $_SESSION['cargo'] == 'Gerente'){

	if(!isset($_GET['id'])){
?>
		<form action="insertDestaque.php" enctype="multipart/form-data" method="POST">
			<select name="partida" required>
				<option selected hidden disabled value=''>Selecione uma partida</option>
				<?php
				if($_SESSION['cargo'] == 'Administrador'){
					for ($i=0; $i < $numPermissao; $i++) { 
						$exec = $dao->consultarPartida($idEsporte[$i], $_SESSION['torneio']);
						foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_partida']?>"><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
						}
					}
				}else if($_SESSION['cargo'] == 'Gerente'){
					$exec = $dao->consultarPartidaGerente($_SESSION['torneio']);
					foreach ($exec as $listar) {
				?>
					<option value="<?php echo $listar['id_partida']?>"><?php echo $listar['esporte'].' - '.$listar['dia'].' - '.$listar['equipe_a'].' vs. '.$listar['equipe_b'];?></option>
				<?php
					}
				}
				?>
			</select>
			<textarea name="texto" placeholder="Digite o texto de destaque"></textarea>
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
		$destaque = $dao->consultar($id);
 ?>

	<form action="updateDestaque.php" enctype="multipart/form-data" method="POST">
		<input type="text" name="id" value="<?php echo $destaque->getidDestaque(); ?> " hidden>
		<select name="partida" required>
			<option selected hidden disabled value=''>Selecione uma partida</option>
				<?php
					$exec = $dao->consultarPartidaGerente($_SESSION['torneio']);
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
			</select>
		<textarea name="texto" placeholder="Digite o texto de destaque"><?php echo $destaque->getTexto();?></textarea>
		<div class='container_img'>
			<div class='select_img' style='background-image: url(/public/img/destaque/<?php echo $destaque->getImagem(); ?>)'></div>
			<input type="file" name="imagem" id='imagem' accept="image/*" hidden>
			<label for='imagem'>Selecione uma imagem</label>
		</div>
		<input type="submit" value='Enviar'>
		</form>

<?php
	}
}else{
	header('location: /error/403');
}
?>
</body>
</html>