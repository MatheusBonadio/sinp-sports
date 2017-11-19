<html>
<body>
<?php
	require_once '../../class/Equipe.php';
	require_once '../../dao/EquipeDAO.php';
	$equipe = new Equipe();
	$dao = new EquipeDAO();


	if(!isset($_GET['id'])){
?>
	
		<form action="insertEquipe.php" method="POST">
			nome<input type="text" name="nome"><br>
			sigla<input type="text" name="sigla" maxlength="6" style='text-transform: uppercase;'><br>
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
			vitorias<input type="number" name="vitorias" value="0" disabled><br>
			empates<input type="number" name="empates" value="0" disabled><br>
			derrotas<input type="number" name="derrotas" value="0" disabled><br>
			pontos<input type="number" name="pontos" value="0" disabled><br>

			<input type="submit">
		</form>
	
<?php 
	}
	else{
		$id = $_GET['id'];
		$equipe = $dao->consultar($id);

 ?>
		<form action="updateEquipe.php" method="POST">
			id<input type="text" name="id" value="<?php echo $equipe->getidEquipe(); ?>"><br>
			nome<input type="text" name="nome" value="<?php echo $equipe->getNome(); ?>"><br>
			sigla<input type="text" name="sigla" value="<?php echo $equipe->getSigla(); ?>"><br>
			torneio<select name='torneio'>
				<?php 
					$exec = $dao->consultarTorneio();
					foreach ($exec as $listar) {
						if($listar['id_torneio'] == $equipe->getidTorneio()){
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
			vitorias<input type="number" name="vitorias" value="<?php echo $equipe->getVitorias(); ?>"><br>
			empates<input type="number" name="empates" value="<?php echo $equipe->getEmpates(); ?>"><br>
			derrotas<input type="number" name="derrotas" value="<?php echo $equipe->getDerrotas(); ?>"><br>
			pontos<input type="number" name="pontos" value="<?php echo $equipe->getPontos(); ?>"><br>
			<input type="submit">
		</form>
<?php
	}
?>
</body>
</html>