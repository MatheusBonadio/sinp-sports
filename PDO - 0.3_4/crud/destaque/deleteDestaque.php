<?php
	require_once '../../class/Destaque.php';
	require_once '../../dao/DestaqueDAO.php';
	$destaque = new Destaque();
	$dao = new DestaqueDAO();

	$id = $_GET['id'];
	$destaque = $dao->consultar($id);
	$imagem = $destaque->getImagem();
    unlink('../../img/destaque/'.$imagem);

	/*$esporte->setDestaque($_POST['esporte']);
	$esporte->setGenero($_POST['genero']);
	$esporte->setTipo($_POST['tipo']);
	$esporte->setqtdJogadores($_POST['qtdJogadores']);
	$esporte->setClassificacao($_POST['classificacao']);
	
	$imagem = $_FILES['imagem'];
	$arquivo = str_replace(" ","",$esporte->getDestaque().".".pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../img/esporte/'.$arquivo);

	$esporte->setImagem($arquivo);*/

	$dao->excluir($id);

	header('location:selectDestaque.php');
?>
