<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/DestaqueDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Destaque.php';
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
	$destaque = new Destaque();
	$daoAdm = new AdministradorDAO();
	$dao = new DestaqueDAO();
	
	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
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
<?php if($_SESSION['cargo'] == 'Administrador'){

	for ($i=0; $i < $numPermissao; $i++) { 
		$execPart = $dao->consultarPartida($idEsporte[$i], $_SESSION['torneio']);
		foreach ($execPart as $linha) {    
			$exec = $dao->listarEsporte($idEsporte[$i], $_SESSION['torneio'], $linha['id_partida']);
				foreach ($exec as $listar) {?>
					<div class='block'>
						<div class='img' style='background-image: url(/public/img/destaque/<?php echo $listar['imagem'] ?>);background-size: cover;'></div>
						<div class='info'>
							<div class='info_name'><?php echo $listar['esporte'] ?></div>
							<div class='info_data'>
								<?php echo $listar['texto'] ?><br />
							</div>
							<div class='buttons'>
								<a href=formDestaque.php?id=<?php echo $listar['id_destaque']?>>Alterar</a>
								<a href=deleteDestaque.php?id=<?php echo $listar['id_destaque']?>>Excluir</a>
							</div>
						</div>
					</div>
				<?php }
		}
	}
}else if ($_SESSION['cargo'] == 'Gerente') {
	$exec = $dao->listar($_SESSION['torneio']);
		foreach ($exec as $listar) {?>
			<div class='block'>
				<div class='img' style='background-image: url(/public/img/destaque/<?php echo $listar['imagem'] ?>);background-size: cover;'></div>
				<div class='info'>
					<div class='info_name'><?php echo $listar['esporte'] ?></div>
					<div class='info_data'>
						<?php echo $listar['texto'] ?><br />
					</div>
					<div class='buttons'>
						<a href=formDestaque.php?id=<?php echo $listar['id_destaque']?>>Alterar</a>
						<a href=deleteDestaque.php?id=<?php echo $listar['id_destaque']?>>Excluir</a>
					</div>
				</div>
			</div>
		<?php }
}

?>
<a class='insert material-icons flex' href='formDestaque.php'>add</a>
</div>