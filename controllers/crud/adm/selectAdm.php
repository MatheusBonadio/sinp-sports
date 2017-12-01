<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/AdministradorDAO.php';
session_write_close();
include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
$dao = new AdministradorDAO();

if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
	header('location: /error/403');
}

if(!isset($_SESSION['cargo'])){
	header('location: /error/403');
}

if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar($_SESSION['torneio']);?>

	<div class='container_header flex'>Administrador</div>
	<div class='container_body'>
	<?php foreach ($exec as $listar) {?>
		<div class='block'>
			<div class='img' style='background-image: url(/public/img/sistema/user.png);'></div>
			<div class='info'>
				<div class='info_name'><?php echo $listar['nome'] ?></div>
				<div class='info_data'>
					<?php echo $listar['login'] ?><br />
					<?php echo $listar['email'] ?><br />
					<?php echo $listar['descricao'] ?><br />
					<?php echo $listar['cargo'] ?><br />
				</div>
				<div class='buttons'>
					<a href=formAdm.php?id=<?php echo $listar['id_adm']?>>Alterar</a>
					<a href=formCargo.php?id=<?php echo $listar['id_adm']?>>Cargo</a>
					<a href=deleteAdm.php?id=<?php echo $listar['id_adm']?>&login=<?php echo $listar['login']?> class='delete'>Excluir</a>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	</div>
	<a class='insert material-icons flex' href='cargo.php'>add</a>
<?php
}
?>