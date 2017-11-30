<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	$dao = new PartidaDAO();
	$daoAdm = new AdministradorDAO();
	

	$i = 0;	
	foreach($_SESSION['permissao'] as $value){
  		 foreach($value as $v_key){
        	$idEsporte[$i] = $v_key;
        	$i++;
   }
}

	$numPermissao = $daoAdm->consultarNumPermissao($_SESSION['login']);

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

if($_SESSION['cargo'] == 'Administrador'){

	for ($i=0; $i < $numPermissao; $i++) { 
		$exec = $dao->listarEsporte($idEsporte[$i], $_SESSION['torneio']);

		foreach ($exec as $listar) {
			echo "ID: ".$listar['id_partida']."<br>";
			echo "EquipeA: ".$listar['nome_equipe_a']."<br>";
			echo "EquipeB: ".$listar['nome_equipe_b']."<br>";
			echo "Esporte: ".$listar['id_esporte']."<br>";
			echo "Fase: ".$listar['id_fase']."<br>";
			echo "Torneio: ".$listar['id_torneio']."<br>";
			echo "Dia: ".$listar['dia']."<br>";
			echo "Inicio: ".$listar['inicio']."<br>";
			echo "Termino: ".$listar['termino']."<br>";
			echo "PlacarA: ".$listar['placar_equipe_a']."<br>";
			echo "PlacarB: ".$listar['placar_equipe_b']."<br>";
			echo "Vencedor: ".$listar['vencedor']."<br>";
			echo "<a href=formPontuacao.php?id=".$listar['id_partida'].">SCORE</a><br>";
		}
	}
}

if($_SESSION['cargo'] == 'Gerente'){
		$exec = $dao->listar($_SESSION['torneio']);

		foreach ($exec as $listar) {
			echo "ID: ".$listar['id_partida']."<br>";
			echo "EquipeA: ".$listar['nome_equipe_a']."<br>";
			echo "EquipeB: ".$listar['nome_equipe_b']."<br>";
			echo "Esporte: ".$listar['id_esporte']."<br>";
			echo "Fase: ".$listar['id_fase']."<br>";
			echo "Torneio: ".$listar['id_torneio']."<br>";
			echo "Dia: ".$listar['dia']."<br>";
			echo "Inicio: ".$listar['inicio']."<br>";
			echo "Termino: ".$listar['termino']."<br>";
			echo "PlacarA: ".$listar['placar_equipe_a']."<br>";
			echo "PlacarB: ".$listar['placar_equipe_b']."<br>";
			echo "Vencedor: ".$listar['vencedor']."<br>";
			echo "<a href=formPartida.php?id=".$listar['id_partida'].">ALTERAR</a><br>";
			echo "<a href=deletePartida.php?id=".$listar['id_partida'].">EXCLUIR</a><br>";

		}
?>
	<a href="formPartida.php">INSERIR</a><br>
<?php
}
?>

<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>