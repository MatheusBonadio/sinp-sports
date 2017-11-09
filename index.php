<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include("config.php");?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="<?php echo JS; ?>jquery.js"></script>
        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <meta name='theme-color' content='#141414'>
        <meta charset='UTF-8'>
        <title>Sinp Sports | Gerenciador de competiões esportivas</title>
        <meta content='width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=0' name='viewport' />
        <link rel="shortcut icon" href="<?php echo IMG; ?>/sistema/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo CSS; ?>index.css" type="text/css">
    </head>
<body>
    <div class='header flex'>
        <a href=''>
            <div class='img'></div>
        </a>
        <a onclick='select_head(0)'>home</a>
        <a onclick='select_head(1)'>partidas</a>
        <a onclick='select_head(2)'>esportes</a>
        <a onclick='select_head(3)'>sobre nós</a>
        <a onclick='select_head(4)'>
            <label>login</label>
            <div class='material-icons'>directions_walk</div>
        </a>
    </div>

    <div id='loader' class='flex'>
        <div class='loader'></div>
        <label>Loading</label>
    </div>

    <div class="content flex"><?php include("pages/home.php") ?></div>

    <?php include("footer.php");?>