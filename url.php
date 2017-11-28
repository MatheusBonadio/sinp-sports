<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/controllers/dao/TorneioDAO.php";
$dao = new TorneioDAO();
$exec = $dao->listar();

$torneioExiste = false;
$url = "";

if(isset($_GET["torneio"])){
	foreach ($exec as $listar) {
		if($dao->normalizaURL($listar["descricao"]) == $_GET["torneio"]){
			$torneioExiste = true;
			$idTorneio = $listar["id_torneio"];
		}
	}

	if($torneioExiste){
		$_SESSION["descricao"] = $_GET["torneio"];
		$_SESSION["torneio"] = $idTorneio;
	    $url = (isset($_GET["url"])) ? $_GET["url"]:"home";
	    $url = $_SERVER["DOCUMENT_ROOT"]."/pages/".$url.".php";
	}
}
if(isset($_SESSION["descricao"]))
	$torneio = $_SESSION["descricao"];
else
	header("location: /");

if(!file_exists($url)){
	$url = (isset($_GET["url"])) ? $_GET["url"]:"404";
	if($url=="403")
    	$url = $_SERVER["DOCUMENT_ROOT"]."/errors/403.php";
    else 
    	$url = $_SERVER["DOCUMENT_ROOT"]."/errors/404.php";
}

session_write_close();