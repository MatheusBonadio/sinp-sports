<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Esporte.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
$esporte = new Esporte();
$dao = new EsporteDAO();


	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

$esporte->setidEsporte($_POST['id']);
$esporte->setidTorneio($_SESSION['torneio']);
$esporte->setEsporte($_POST['esporte']);
$esporte->setGenero($_POST['genero']);
$esporte->setTipo($_POST['tipo']);
$esporte->setqtdJogadores($_POST['qtdJogadores']);
$esporte->setqtdTimes($_POST['qtdTimes']);
$esporte->setClassificacao($_POST['classificacao']);

$diretorio = $_SERVER['DOCUMENT_ROOT'].'/public/img/esporte/';

if($_FILES['imagem']['error']==0){
	$espImg = $dao->consultar($_POST['id']);
	$imagem = $espImg->getImagem();
	unlink($diretorio.$imagem);

	$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$nome = sha1(microtime()).".".$ext;
	move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nome);
	$esporte->setImagem($nome);
	$dao->alterarImagem($esporte);
}else
	$dao->alterar($esporte);

header('location:selectEsporte.php');