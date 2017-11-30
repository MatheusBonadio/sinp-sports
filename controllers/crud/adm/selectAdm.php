<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$dao = new AdministradorDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

if($_SESSION['cargo'] == 'Gerente'){
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
		echo "<a href=formAdm.php?id=".$listar['id_adm'].">ALTERAR DADOS</a><br>";
		echo "<a href=formCargo.php?id=".$listar['id_adm'].">ALTERAR CARGO</a><br>";
		echo "<a href=deleteAdm.php?id=".$listar['id_adm']."&login=".$listar['login'].">EXCLUIR</a><br>";
	}
?>

<a href="cargo.php">INSERIR</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>

<?php
}
?>