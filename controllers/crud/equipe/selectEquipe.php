<?php
	require_once '../../dao/EquipeDAO.php';
	$dao = new EquipeDAO();	
	session_start();

	if($_SESSION['cargo'] == 'Representante'){
		$exec = $dao->listarEquipeRepre($_SESSION['login'], $_SESSION['torneio']);
	}else

	if($_SESSION['cargo'] == 'Gerente'){
		$exec = $dao->listar($_SESSION['torneio']);
	}

	if($_SESSION['cargo'] == 'Administrador'){
		header('location: ../../../errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: ../../../errors/403.php');
	}

	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_equipe']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Nome: ".$listar['nome']."<br>";
		echo "Sigla: ".$listar['sigla']."<br>";
		echo "Vitorias: ".$listar['vitorias']."<br>";
		echo "Empates: ".$listar['empates']."<br>";
		echo "Derrotas: ".$listar['derrotas']."<br>";
		echo "Pontos: ".$listar['pontos']."<br>";
		echo "Representante: ".$listar['representante']."<br>";
		echo "Logo: ".$listar['logo']."<br>";
		echo "<a href=formEquipe.php?id=".$listar['id_equipe'].">ALTERAR</a><br>";
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
	<a href='../../../painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>
	