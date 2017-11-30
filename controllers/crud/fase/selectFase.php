<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/FaseDAO.php';
	$dao = new FaseDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar();
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_fase']."<br>";
		echo "Descricao: ".$listar['fase_descricao']."<br>";
		echo "Indice: ".$listar['fase_indice']."<br>";
		echo "<a href=formFase.php?id=".$listar['id_fase'].">ALTERAR</a><br>";
		echo "<a href=deleteFase.php?id=".$listar['id_fase'].">EXCLUIR</a><br>";
	}
?>
<a href="formFase.php">INSERIR</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>

<?php
}
?>