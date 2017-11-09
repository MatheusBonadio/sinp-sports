<?php
	require_once '../../class/Destaque.php';
	require_once '../../dao/DestaqueDAO.php';
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	$destaque = $dao->consultar($_POST['id']);
	$imagem = $destaque->getImagem();
    unlink('../../img/destaque/'.$imagem);

	$destaque->setidDestaque($_POST['id']);
	$destaque->setidPartida($_POST['partida']);
	$destaque->setTexto($_POST['texto']);

	if(isset($_FILES['imagem'])){
		$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
		$nome = sha1(microtime()).".".$ext;
		move_uploaded_file($_FILES['imagem']['tmp_name'], '../../img/destaque/'.$nome);
		$destaque->setImagem($nome);
		$dao->alterarImagem($destaque);
	}else
		$dao->alterar($destaque);

	header('location:selectDestaque.php');
?>
