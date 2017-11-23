<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='/public/js/jquery.js'></script>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <meta name='theme-color' content='#141414'>
    <meta charset='UTF-8'>
    <title>Sinp Sports | Gerenciador de competições esportivas</title>
    <meta content='width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=0' name='viewport' />
    <link rel='shortcut icon' href='/public/img/sistema/icon.png' type='image/x-icon'>
    <link rel='stylesheet' href='/public/css/index.css' type='text/css'>
</head>

<body>
    <div class='header flex'>
        <a href=''>
            <div class='img'></div>
        </a>
        <a onclick='select_head(0)'>home</a>
        <a onclick='select_head(1)'>partidas</a>
        <a onclick='select_head(2)'>esportes</a>
        <a onclick='select_head(3)'>equipes</a>
        <a onclick='select_head(4)'>login</a>
    </div>

    <script src='/public/js/header.js'></script>

    <div id='loader' class='flex'>
        <div class='loader'></div>
        <label>Loading</label>
    </div>

    <?php
        $url = (isset($_GET["url"])) ? $_GET["url"]:"home";
        $url = $_SERVER['DOCUMENT_ROOT']."/pages/".$url.".php";
        if(!file_exists($url)) 
            $url = $_SERVER['DOCUMENT_ROOT']."/errors/404.php";
    ?>

    <script>$('#loader').hide();</script>

    <div class='content'><?php include($url) ?></div>
    
    <?php include("footer.php");?>