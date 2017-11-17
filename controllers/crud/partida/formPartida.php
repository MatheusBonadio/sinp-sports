<html>
<body>
<?php
	require_once '../../class/Partida.php';
	require_once '../../dao/PartidaDAO.php';
	require_once '../calendario.html';
	$partida = new Partida();
	$dao = new PartidaDAO();

	if(!isset($_GET['id'])){
?>
		<form action="insertPartida.php" method="POST">
			equipeA<select name='equipeA'>
						<option selected disabled hidden>Selecione uma equipe</option>
					<?php 
						$exec = $dao->consultarEquipe();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select><br>
			equipeB<select name='equipeB'>
						<option selected disabled hidden>Selecione uma equipe</option>
					<?php 
						$exec = $dao->consultarEquipe();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_equipe'];?>"><?php echo $listar['nome']; ?></option>
					<?php
						}
					?>
					</select><br>
			esporte<select name='esporte'>
						<option selected disabled hidden>Selecione um esporte</option>
					<?php 
						$exec = $dao->consultarEsporte();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_esporte'];?>"><?php echo $listar['esporte']; ?></option>
					<?php
						}
					?>
					</select><br>
			fase<select name='fase'>
						<option selected disabled hidden>Selecione uma fase</option>
					<?php 
						$exec = $dao->consultarFase();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['fase_indice'];?>"><?php echo $listar['fase_descricao']; ?></option>
					<?php
						}
					?>
					</select><br>
			torneio<select name='torneio'>
						<option selected disabled hidden>Selecione um torneio</option>
					<?php 
						$exec = $dao->consultarTorneio();
						foreach ($exec as $listar) {
					?>
						<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
					<?php
						}
					?>
					</select><br>
			dia<input id="inicio" type="text" name="dia"><br>
			inicio<input type="text" name="inicio"><br>
			termino<input type="text" name="termino" value="--:--" disabled><br>
			placarA<input type="text" name="placarA" value="0" disabled><br>
			placarB<input type="text" name="placarB" value="0" disabled><br>
			vencedor<input type="text" name="vencedor" value="-" disabled><br>
					
			<input type="submit">
		</form>

<?php 
	}
	else{
		$id = $_GET['id'];
		$partida = $dao->consultar($id);
		//aparecer somente oq o adm pode editar
		//nao poder acessar o formulario pela url = session de login + confirmação de permissao atraves desse sql:
		//select * from permissao where id_esporte = $listar['id_esporte'] and login = $_SESSION['login'];
 ?>

	
		<form action="updatePartida.php" method="POST">
			id<input type="text" name="id" value="<?php echo $partida->getidPartida(); ?> "><br>
			equipeA<select name='equipeA'>
					<?php 
						$exec = $dao->consultarEquipe();
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
					</select><br>

			equipeB<select name='equipeB'>
					<?php 
						$exec = $dao->consultarEquipe();
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
					</select><br>

			esporte<select name='esporte'>
					<?php 
						$exec = $dao->consultarEsporte();
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
					</select><br>

			fase<select name='fase'>
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
					</select><br>

			torneio<select name='torneio'>
					<?php 
						$exec = $dao->consultarTorneio();
						foreach ($exec as $listar) {
							if($listar['id_torneio'] == $partida->getidTorneio()){
					?>
								<option value="<?php echo $listar['id_torneio'];?>" selected><?php echo $listar['descricao']; ?></option>
					<?php
							}else{
					?>
								<option value="<?php echo $listar['id_torneio'];?>"><?php echo $listar['descricao']; ?></option>
					<?php
							}
						}
					?>
					</select><br>

			dia<input id="inicio" type="text" name="dia" value="<?php echo $partida->getDia();?>"><br>
			inicio<input type="text" name="inicio" value="<?php echo $partida->getInicio();?>"><br>
			termino<input type="text" name="termino" value="<?php echo $partida->getTermino();?>"><br>
			placarA<input type="text" name="placarA" value="<?php echo $partida->getPlacarA();?>"><br>
			placarB<input type="text" name="placarB" value="<?php echo $partida->getPlacarB();?>"><br>
			vencedor<select name='vencedor'>
					<?php 
						$exec = $dao->consultarVencedor($id);
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