<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Destaque.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/DestaqueDAO.php';

$destaque = new Destaque();
$dao = new DestaqueDAO();


	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

$destaque->setidDestaque($_POST['id']);
$destaque->setidTorneio($_SESSION['torneio']);
$destaque->setidPartida($_POST['partida']);
$destaque->setTexto($_POST['texto']);

$diretorio = $_SERVER['DOCUMENT_ROOT'].'/public/img/destaque/';

if($_FILES['imagem']['error']==0){
	$desImg = $dao->consultar($_POST['id']);
	$imagem = $desImg->getImagem();
	unlink($diretorio.$imagem);

	$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$nome = sha1(microtime()).".".$ext;
	move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nome);
	$destaque->setImagem($nome);
	$dao->alterarImagem($destaque);
}else
	$dao->alterar($destaque);

header('location:selectDestaque.php');