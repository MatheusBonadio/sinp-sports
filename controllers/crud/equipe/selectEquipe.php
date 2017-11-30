<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EquipeDAO.php';
	$dao = new EquipeDAO();	
	

	if($_SESSION['cargo'] == 'Representante'){
		$exec = $dao->listarEquipeRepre($_SESSION['login'], $_SESSION['torneio']);
	}else

	if($_SESSION['cargo'] == 'Gerente' || $_SESSION['cargo'] == 'Administrador'){
		$exec = $dao->listar($_SESSION['torneio']);
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_equipe']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Nome: ".$listar['nome']."<br>";
		echo "Sigla: ".$listar['sigla']."<br>";
		echo "Ouro: ".$listar['ouro']."<br>";
		echo "Prata: ".$listar['prata']."<br>";
		echo "Bronze: ".$listar['bronze']."<br>";
		echo "Pontos: ".$listar['pontos']."<br>";
		echo "Representante: ".$listar['representante']."<br>";
		echo "Logo: ".$listar['logo']."<br>";
		
		if($_SESSION['cargo'] == 'Gerente' || $_SESSION['cargo'] == 'Representante'){
			echo "<a href=formEquipe.php?id=".$listar['id_equipe'].">ALTERAR</a><br>";
		}
		if($_SESSION['cargo'] == 'Gerente'){
			echo "<a href=deleteEquipe.php?id=".$listar['id_equipe'].">EXCLUIR</a><br>";
		}
	}

	if($_SESSION['cargo'] == 'Gerente'){
?>		
	<a href="formEquipe.php">INSERIR</a><br>
<?php
	}
?>
	<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>
	