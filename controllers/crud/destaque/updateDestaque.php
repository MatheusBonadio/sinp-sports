<?php

require_once '../../class/Destaque.php';
require_once '../../dao/DestaqueDAO.php';

$destaque = new Destaque();
$dao = new DestaqueDAO();

$destaque->setidDestaque($_POST['id']);
$destaque->setidPartida($_POST['partida']);
$destaque->setTexto($_POST['texto']);

if($_FILES['imagem']['error']==0){
	$desImg = $dao->consultar($_POST['id']);
	$imagem = $desImg->getImagem();
	unlink('../../../public/img/destaque/'.$imagem);

	$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$nome = sha1(microtime()).".".$ext;
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../../public/img/destaque/'.$nome);
	$destaque->setImagem($nome);
	$dao->alterarImagem($destaque);
}else
	$dao->alterar($destaque);

header('location:selectDestaque.php');