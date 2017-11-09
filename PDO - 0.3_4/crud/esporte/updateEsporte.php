<?php
	require_once '../../class/Esporte.php';
	require_once '../../dao/EsporteDAO.php';
	$esporte = new Esporte();
	$dao = new EsporteDAO();

	$esporte = $dao->consultar($_POST['id']);
	$imagem = $esporte->getImagem();
    unlink('../../img/esporte/'.$imagem);

	$esporte->setidEsporte($_POST['id']);
	$esporte->setEsporte($_POST['esporte']);
	$esporte->setGenero($_POST['genero']);
	$esporte->setTipo($_POST['tipo']);
	$esporte->setqtdJogadores($_POST['qtdJogadores']);
	$esporte->setClassificacao($_POST['classificacao']);

	if(isset($_FILES['imagem'])){
		$ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
		$nome = sha1(microtime()).".".$ext;
		move_uploaded_file($_FILES['imagem']['tmp_name'], '../../img/esporte/'.$nome);
		$esporte->setImagem($nome);
		$dao->alterarImagem($esporte);
	}else
		$dao->alterar($esporte);

	header('location:selectEsporte.php');
?>
