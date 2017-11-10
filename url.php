<?php

$url = (isset($_GET["url"])) ? $_GET["url"]:"";
$url = array_filter(explode("/",$url));
var_dump($url);