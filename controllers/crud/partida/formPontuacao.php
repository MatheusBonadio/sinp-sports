<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Partida.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/calendario.html';
	$partida = new Partida();
	$dao = new PartidaDAO();

	

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$id = $_GET['id'];
	$partida = $dao->consultar($id, $_SESSION['torneio']);

	$i = 0;
	foreach($_SESSION['permissao'] as $value){
  		foreach($value as $v_key){
	       	$idEsporte[$i] = $v_key;
	       	$i++;
   		}
	}

	$permitido = false;
	for ($i=0; $i < count($idEsporte); $i++) { 
		if($partida->getidEsporte() == $idEsporte[$i]){
			$permitido = true;
		}
	}

	

	if(!$permitido){
		header('location: /error/403');
	}else{
		$exec = $dao->consultarVencedor($id, $_SESSION['torneio']);
			foreach ($exec as $listar) {
 ?>
<html>
<body>
		<form action="scorePartida.php" method="POST">
			<input type="text" name="id" value="<?php echo $partida->getidPartida(); ?> " hidden>
			<input type="text" name="esporte" value="<?php echo $partida->getidEsporte(); ?> " hidden>
			<input type="text" name="equipeA" value="<?php echo $partida->getidEquipeA(); ?> " hidden>
			<input type="text" name="equipeB" value="<?php echo $partida->getidEquipeB(); ?> " hidden>
			Termino<input type="text" name="termino" ><br>
			Placar: <?php echo $listar['nomeA']; ?><input type="number" name="placarA"><br>
			Placar: <?php echo $listar['nomeB']; ?><input type="number" name="placarB"><br>
			vencedor<select name='vencedor'>
					<option selected disabled hidden>Selecione um vencedor</option>
					<?php 
							if($listar['id_equipe_a'] == $partida->getVencedor()){
					?>
								<option value="<?php echo $listar['id_equipe_a'];?>" selected><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>"><?php echo $listar['nomeB']; ?></option>
								<option value="0">Empate</option>
					<?php
							}else if($listar['id_equipe_b'] == $partida->getVencedor()){
					?>
								<option value="<?php echo $listar['id_equipe_a'];?>"><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>" selected><?php echo $listar['nomeB']; ?></option>
								<option value="0">Empate</option>
					<?php
							}else if($partida->getVencedor() == 0){
					?>
								<option value="<?php echo $listar['id_equipe_a'];?>"><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>" selected><?php echo $listar['nomeB']; ?></option>
								<option value="0">Empate</option>
					<?php
							}	
						}
					?>
					</select><br>
					
			<input type="submit">
		</form>

<?php
	}
?>
</body>
</html>