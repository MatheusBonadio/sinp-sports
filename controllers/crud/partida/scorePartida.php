<?php
	require_once '../../class/Partida.php';
	require_once '../../dao/PartidaDAO.php';
	$partida = new Partida();
	$dao = new PartidaDAO();
	session_start();

	$id = $_POST['id'];
	$partida = $dao->consultar($id, $_SESSION['torneio']);

	$i = 0;
	foreach($_SESSION['permissao'] as $value){
  		foreach($value as $v_key){
	       	$idEsporte[$i] = $v_key;
	       	$i++;
   		}
	}

	$permitido = false;
	for ($i=0; $i < count($idEsporte); $i++) { 
		if($_POST['esporte'] == $idEsporte[$i]){
			$permitido = true;
		}
	}

	if($permitido){
		header('location: ../../../errors/403.php');
	}else{
		$partida->setidPartida($_POST['id']);
		$partida->setTermino($_POST['termino']);
		$partida->setPlacarA($_POST['placarA']);
		$partida->setPlacarB($_POST['placarB']);
		$partida->setVencedor($_POST['vencedor']);

		$dao->pontuacao($partida);

		header('location: selectPartida.php');
	}


