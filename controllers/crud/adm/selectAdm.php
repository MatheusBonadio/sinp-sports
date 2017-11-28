<?php
	session_start();
	require_once '../../dao/AdministradorDAO.php';
	$dao = new AdministradorDAO();
	$exec = $dao->listar($_SESSION['torneio']);

	
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_adm']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Login: ".$listar['login']."<br>";
		echo "Senha: ".$listar['senha']."<br>";
		echo "email: ".$listar['email']."<br>";
		echo "nome: ".$listar['nome']."<br>";
		echo "cargo: ".$listar['cargo']."<br>";
		echo "Permissões:<br>";
		$permExec = $dao->consultarPermissao($listar['login']);
		foreach ($permExec as $listarEsporte) {
			echo $listarEsporte['esporte']."<br>";
		}
		echo "<a href=formAdm.php?id=".$listar['id_adm'].">ALTERAR</a><br>";
		echo "<a href=deleteAdm.php?id=".$listar['id_adm']."&login=".$listar['login'].">EXCLUIR</a><br>";
	}
?>