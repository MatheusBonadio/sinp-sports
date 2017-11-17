<html>
<body>
<?php
	require_once '../../class/Administrador.php';
	require_once '../../dao/AdministradorDAO.php';
	$adm = new Administrador();
	$dao = new AdministradorDAO();

	if(!isset($_GET['id'])){
?>
		<form action="insertAdm.php" method="POST">
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
			login<input type="text" name="adm_login"><br>
			email<input type="text" name="email"><br>
			nome<input type="text" name="nome"><br>
			cargo<select type="text" name="cargo">
					<option selected disabled hidden>Selecione um cargo</option>
					<option value="gerente">Gerente</option>
					<option value="adm">Administrador</option>
					<option value="representante">Representante</option>
				</select>
			permissao<br>
					<?php 
						$exec = $dao->consultarEsporte();
						foreach ($exec as $listar) {
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					?>
			<input type="submit">
		</form>

<?php 
	}
	else{
		$id = $_GET['id'];
		$adm = $dao->consultar($id);
		$exec = $dao->consultarPermissao($adm->getLogin());
		$idTorneio = $dao->consultarTorneioID($adm->getidTorneio());
		$cargo  = $dao->consultarCargoID($adm->getCargo());
			foreach ($exec as $listar) {
				$arrayChecked[$listar['id_esporte']] = $listar['id_esporte'];
			}
 ?>

	
		<form action="updateAdm.php" method="POST">
			id<input type="text" name="id" value="<?php echo $adm->getidAdm(); ?> "><br>
			torneio<select name='torneio'>
					<?php 
						$exec = $dao->consultarTorneio();
						foreach ($exec as $listar) {
							if($listar['id_torneio'] == $idTorneio){
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
			login<input type="text" name="login" value="<?php echo $adm->getLogin(); ?> "><br>
			senha<input type="text" name="senha" value="<?php echo $adm->getSenha(); ?> "><br>
			email<input type="text" name="email" value="<?php echo $adm->getEmail(); ?> "><br>
			nome<input type="text" name="nome" value="<?php echo $adm->getNome(); ?> "><br>
			cargo<select name='cargo'>
					<?php 
						$exec = $dao->consultarCargo();
						foreach ($exec as $listar) {
							if($listar['cargo'] == $cargo){
					?>
								<option value="<?php echo $listar['cargo'];?>" selected><?php echo $listar['cargo']; ?></option>
					<?php
							}else{
								//fazer igual o esporte
					?>
								<option value="<?php echo $listar['cargo'];?>"><?php echo $listar['cargo']; ?></option>
					<?php
							}
						}
					?>
					</select><br>
			permissao<br>
				<?php 
					$exec = $dao->consultarEsporte();
					foreach ($exec as $listar) {
						if(isset($arrayChecked[$listar['id_esporte']]) && $listar['id_esporte'] == $arrayChecked[$listar['id_esporte']]){
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>' checked>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}else{
					?>
						<input type='checkbox' name='permissao[]' value='<?php echo $listar['id_esporte']; ?>'>
						<label><?php echo $listar['esporte']; ?></label><br>
					<?php
						}
					}
					?>
			<input type="submit">
		</form>	

<?php
	}
?>
</body>
</html>