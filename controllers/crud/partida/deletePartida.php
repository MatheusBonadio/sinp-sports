<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Partida.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	$partida = new Partida();
	$dao = new PartidaDAO();

	$id = $_GET['id'];
	$dao->excluir($id);


	header('location:selectPartida.php');
?>
