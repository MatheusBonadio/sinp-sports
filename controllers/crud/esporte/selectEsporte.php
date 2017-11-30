<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/EsporteDAO.php';
	$dao = new EsporteDAO();
	

	if($_SESSION['cargo'] == 'Representante' || $_SESSION['cargo'] == 'Administrador'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

if($_SESSION['cargo'] == 'Gerente'){
	$exec = $dao->listar($_SESSION['torneio']);
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_esporte']."<br>";
		echo "Torneio: ".$listar['id_torneio']."<br>";
		echo "Esporte: ".$listar['esporte']."<br>";
		echo "Genero: ".$listar['genero']."<br>";
		echo "Tipo: ".$listar['tipo']."<br>";
		echo "Qtd Jogadores: ".$listar['qtd_jogadores']."<br>";
		echo "Qtd Times: ".$listar['qtd_times']."<br>";
		echo "Classificacao: ".$listar['classificacao']."<br>";
		echo "Imagem: ".$listar['imagem']."<br>";
		echo "<a href=formEsporte.php?id=".$listar['id_esporte'].">ALTERAR</a><br>";
		echo "<a href=deleteEsporte.php?id=".$listar['id_esporte'].">EXCLUIR</a><br>";
	}
?>
<a href="formEsporte.php">INSERIR</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>
<?php
}
?>