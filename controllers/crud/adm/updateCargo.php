<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	$adm->setidAdm($_POST['id']);
	$adm->setCargo($_POST['cargo']);

	$dao->alterarCargo($adm);

	header('location:selectAdm.php');
?>