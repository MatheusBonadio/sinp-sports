<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/class/Partida.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/PartidaDAO.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/crud/calendario.html';
	$partida = new Partida();
	$dao = new PartidaDAO();

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /errors/403.php');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /errors/403.php');
	}
	
	?>
	<div class='container_header flex'>Partida</div>
	<div class='container_body'>
	<?php if($_SESSION['cargo'] == 'Gerente'){
		if(!isset($_GET['id'])){
?>
		<form action="insertPartida.php" method="POST">
			<select name='equipeA' required>
						<option selected disabled hidden value=''>Selecione a primeira equipe</option>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select>
			<select name='equipeB' required>
						<option selected disabled hidden value=''>Selecione a segunda equipe</option>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select>
			<select name='esporte' required>
						<option selected disabled hidden value=''>Selecione um esporte</option>
					<?php 
						$exec = $dao->consultarEsporte($_SESSION['torneio']);
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_esporte'];?>"><?php echo $listar['esporte']; ?></option>
					<?php
						}
					?>
					</select>
			<select name='fase' required>
						<option selected disabled hidden value=''>Selecione uma fase</option>
					<?php 
						$exec = $dao->consultarFase();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['fase_indice'];?>"><?php echo $listar['fase_descricao']; ?></option>
					<?php
						}
					?>
					</select>
			<input id="inicio" type="text" name="dia" placeholder="Selecione o dia da partida" required>
			<input type="text" name="inicio" placeholder="Digite o inicio da partida" required>
			<input type="submit" value='Enviar'>
		</form>

<?php 
	}else{
		$id = $_GET['id'];
		$partida = $dao->consultar($id, $_SESSION['torneio']);

 ?>

	
		<form action="updatePartida.php" method="POST">
			<input type="text" name="id" value="<?php echo $partida->getidPartida(); ?>" hidden>
			<select name='equipeA'>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
							if($listar['id_equipe'] == $partida->getidEquipeA()){
					?>
								<option value="<?php echo $listar['id_equipe'];?>" selected><?php echo $listar['nome']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
							}
						}
					?>
					</select>

			<select name='equipeB'>
					<?php 
						$exec = $dao->consultarEquipe($_SESSION['torneio']);
						foreach ($exec as $listar) {
							if($listar['id_equipe'] == $partida->getidEquipeB()){
					?>
								<option value="<?php echo $listar['id_equipe'];?>" selected><?php echo $listar['nome']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
							}
						}
					?>
					</select>

			<select name='esporte'>
					<?php 
						$exec = $dao->consultarEsporte($_SESSION['torneio']);
						foreach ($exec as $listar) {
							if($listar['id_esporte'] == $partida->getidEsporte()){
					?>
								<option value="<?php echo $listar['id_esporte'];?>" selected><?php echo $listar['esporte']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['id_esporte'];?>"><?php echo $listar['esporte']; ?></option>
					<?php
							}
						}
					?>
					</select>

			<select name='fase'>
					<?php 
						$exec = $dao->consultarFase();
						foreach ($exec as $listar) {
							if($listar['fase_indice'] == $partida->getidFase()){
					?>
								<option value="<?php echo $listar['fase_indice'];?>" selected><?php echo $listar['fase_descricao']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['fase_indice'];?>"><?php echo $listar['fase_descricao']; ?></option>
					<?php
							}
						}
					?>
					</select>

			<input id="inicio" type="text" name="dia" value="<?php echo $partida->getDia();?>" placeholder='Selecione o dia da partida' required>
			<input type="text" name="inicio" value="<?php echo $partida->getInicio();?>" placeholder='Digite o inicio da partida' required>
			<input type="text" name="termino" value="<?php echo $partida->getTermino();?>" placeholder='Digite o término da partida'>
			<input type="number" name="placarA" value="<?php echo $partida->getPlacarA();?>" placeholder='Digite o placar da primeira equipe'>
			<input type="number" name="placarB" value="<?php echo $partida->getPlacarB();?>" placeholder='Digite o placar da segunda equipe'>
			<select name='vencedor'>
					<?php 
						$exec = $dao->consultarVencedor($id, $_SESSION['torneio']);
						foreach ($exec as $listar) {
							if($listar['id_equipe_a'] == $partida->getVencedor()){
					?>
								<option value="<?php echo $listar['id_equipe_a'];?>" selected><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>"><?php echo $listar['nomeB']; ?></option>
					<?php
							}else if($listar['id_equipe_b'] == $partida->getVencedor()){
					?>
								<option value="<?php echo $listar['id_equipe_a'];?>"><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>" selected><?php echo $listar['nomeB']; ?></option>
					<?php
							}else{
					?>
								<option selected disabled hidden>Selecione um vencedor</option>
								<option value="<?php echo $listar['id_equipe_a'];?>"><?php echo $listar['nomeA']; ?></option>
								<option value="<?php echo $listar['id_equipe_b'];?>"><?php echo $listar['nomeB']; ?></option>
								<option value="0">Empate</option>
					<?php
							}	
						}
					?>
					</select>
					
			<input type="submit" value='Enviar'>
		</form>

<?php
		}
	}else{
		header('location: /error/403');
	}
?>
</body>
</html>