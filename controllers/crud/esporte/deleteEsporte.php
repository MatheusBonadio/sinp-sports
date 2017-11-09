<?php
	require_once '../../class/Esporte.php';
	require_once '../../dao/EsporteDAO.php';
	$esporte = new Esporte();
	$dao = new EsporteDAO();

	$id = $_GET['id'];
	$esporte = $dao->consultar($id);
	$imagem = $esporte->getImagem();
    unlink('../../img/esporte/'.$imagem);

	/*$esporte->setEsporte($_POST['esporte']);
	$esporte->setGenero($_POST['genero']);
	$esporte->setTipo($_POST['tipo']);
	$esporte->setqtdJogadores($_POST['qtdJogadores']);
	$esporte->setClassificacao($_POST['classificacao']);
	
	$imagem = $_FILES['imagem'];
	$arquivo = str_replace(" ","",$esporte->getEsporte().".".pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../img/esporte/'.$arquivo);

	$esporte->setImagem($arquivo);*/

	$dao->excluir($id);

	header('location:selectEsporte.php');
?>
