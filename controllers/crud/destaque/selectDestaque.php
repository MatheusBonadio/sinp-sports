<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/DestaqueDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Destaque.php';
	$destaque = new Destaque();
	$daoAdm = new AdministradorDAO();
	$dao = new DestaqueDAO();
	
	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$i = 0;	
		foreach($_SESSION['permissao'] as $value){
	  		 foreach($value as $v_key){
	        	$idEsporte[$i] = $v_key;
	        	$i++;
	   }
	}

	$numPermissao = $daoAdm->consultarNumPermissao($_SESSION['login']);

	

if($_SESSION['cargo'] == 'Administrador' || $_SESSION['cargo'] == 'Gerente'){

	for ($i=0; $i < $numPermissao; $i++) { 
		$execPart = $dao->consultarPartida($idEsporte[$i], $_SESSION['torneio']);
		foreach ($execPart as $linha) {    
			$exec = $dao->listarEsporte($idEsporte[$i], $_SESSION['torneio'], $linha['id_partida']);
				foreach ($exec as $listar) {
					echo "ID: ".$listar['id_destaque']."<br>";
					echo "Torneio: ".$listar['id_torneio']."<br>";
					echo "Partida: ".$listar['id_partida']."<br>";
					echo "Esporte: ".$listar['esporte']."<br>";
					echo "Texto: ".$listar['texto']."<br>";
					echo "Imagem: ".$listar['imagem']."<br>";
					echo "<a href=formDestaque.php?id=".$listar['id_destaque'].">ALTERAR</a><br>";
					echo "<a href=deleteDestaque.php?id=".$listar['id_destaque'].">EXCLUIR</a><br>";
				}
		}
	}
}

?>
<a href="formDestaque.php">INSERIR</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>