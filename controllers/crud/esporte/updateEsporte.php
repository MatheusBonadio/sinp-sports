<?php

require_once '../../class/Esporte.php';
require_once '../../dao/EsporteDAO.php';

$esporte = new Esporte();
$dao = new EsporteDAO();

$esporte->setidEsporte($_POST['id']);
$esporte->setidTorneio($_POST['torneio']);
$esporte->setEsporte($_POST['esporte']);
$esporte->setGenero($_POST['genero']);
$esporte->setTipo($_POST['tipo']);
$esporte->setqtdJogadores($_POST['qtdJogadores']);
$esporte->setqtdTimes($_POST['qtdTimes']);
$esporte->setClassificacao($_POST['classificacao']);

if($_FILES['imagem']['error']==0){
	$espImg = $dao->consultar($_POST['id']);
	$imagem = $espImg->getImagem();
	unlink('../../../public/img/esporte/'.$imagem);

	$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
	$nome = sha1(microtime()).".".$ext;
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../../public/img/esporte/'.$nome);
	$esporte->setImagem($nome);
	$dao->alterarImagem($esporte);
}else
	$dao->alterar($esporte);

header('location:selectEsporte.php');