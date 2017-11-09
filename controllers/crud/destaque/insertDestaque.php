<?php
	require_once '../../class/Destaque.php';
	require_once '../../dao/DestaqueDAO.php';
	
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	$destaque->setidPartida($_POST['partida']);
	$destaque->setTexto($_POST['texto']);
	
	$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$nome = sha1(microtime()).".".$ext;
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../../public/img/destaque/'.$nome);
	$destaque->setImagem($nome);

	$dao->inserir($destaque);

	header('location:selectDestaque.php');
?>
