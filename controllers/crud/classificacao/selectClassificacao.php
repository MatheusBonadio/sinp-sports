<?php
	session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/dao/ClassificacaoDAO.php';
	$dao = new ClassificacaoDAO();
	

	if($_SESSION['cargo'] == 'Representante'){
		header('location: /error/403');
	}

	if(!isset($_SESSION['cargo'])){
		header('location: /error/403');
	}

	$exec = $dao->listar($_SESSION['torneio']);
	foreach ($exec as $listar) {
		echo "ID: ".$listar['id_classificacao']."<br>";
		echo "Equipe: ".$listar['nomeEquipe']."<br>";
		echo "Esporte: ".$listar['nomeEsporte']."<br>";
		echo "Pontuacao: ".$listar['pontuacao']."<br>";
	}
	if($_SESSION['cargo'] == 'Gerente'){
		echo "<a href=deleteClassificacao.php?id=".$listar['id_classificacao'].">EXCLUIR</a><br>";
?>
<a href="insertClassificacao.php">INSERIR CLASSIFICACOES</a><br>
<a href='/painel/painel<?php echo $_SESSION['cargo'] ?>.php'>MENU</a><br>
<?php
}
?>