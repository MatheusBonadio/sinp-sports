<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/TorneioDAO.php";
	error_reporting(0);
	$dao = new TorneioDAO();
	$_SESSION['torneio'] = $_GET['torneio'];
	$_SESSION['descricao'] = $dao->normalizaURL($_GET['descricao']);
	$_SESSION['descricao2'] = $_GET['descricao'];
	if(isset($_SESSION['torneio']))
		header("location: /".$dao->normalizaURL($_SESSION['descricao'])."/");
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <meta name='theme-color' content='#141414'>
    <meta charset='UTF-8'>
    <title>Sinp Sports | Gerenciador de competições esportivas</title>
    <meta content='width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=0' name='viewport' />
    <link rel='shortcut icon' href='/public/img/sistema/icon.png' type='image/x-icon'>
    <link rel='stylesheet' href='/public/css/index.css' type='text/css'>
    <link rel='stylesheet' href='/public/css/torneio.css' type='text/css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='/public/js/torneio.js'></script>
</head>

<body>
	<div class='container'>
		<div class='logo'></div>
		<div class='search_container'>
			<div class='search'>
				<input type='text' id='search' value='' placeholder='Pesquise uma competição' />
				<div class='search_icon material-icons flex'>search</div>
				<div class='results'></div>
			</div>
		</div>
	</div>
</body>