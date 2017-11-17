<?php

require_once '../../class/Administrador.php';
require_once '../../dao/AdministradorDAO.php';
require_once 'email/mail.php';

$adm = new Administrador();
$dao = new AdministradorDAO();
$mail = new Mail();
$senha = $mail->gerarSenha();
$mail->configurarEmail($_POST['nome'], $_POST['email'], $senha, $_POST['adm_login']);

$adm->setidTorneio($_POST['torneio']);
$adm->setLogin($_POST['adm_login']);
$adm->setSenha($senha);
$adm->setEmail($_POST['email']);
$adm->setNome($_POST['nome']);
$adm->setCargo($_POST['cargo']);
$permissao = $_POST['permissao'];

$dao->inserirPermissao($adm, $permissao);
$dao->inserir($adm);


header('location:selectAdm.php');