<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();
	session_start();

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}
	
	$equipe->setidEquipe($_POST['id']);
	$equipe->setNome($_POST['nome']);
	$equipe->setSigla($_POST['sigla']);
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/public/img/equipe/';

if(!isset($_FILES['logo'])){
	header("refresh:0 url= formEquipe.php?id=".$equipe->getidEquipe());
	echo "<script>alert('Insira uma Logo');</script>";
}


	if($_FILES['logo']['error']==0){
		$equLogo = $dao->consultar($_POST['id'], $_SESSION['torneio']);
		$logo = $equLogo->getLogo();
		unlink($diretorio.$logo);

		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
		$nome = sha1(microtime()).".".$ext;
		move_uploaded_file($_FILES['logo']['tmp_name'], $diretorio.$nome);
		$equipe->setLogo($nome);
		$dao->alterarLogo($equipe);
	}

	$dao->alterar($equipe);
	
	header('location:selectEquipe.php');
?>