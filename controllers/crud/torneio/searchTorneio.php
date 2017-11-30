<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/dao/TorneioDAO.php";
$dao = new TorneioDAO();

if(!isset($_GET['search']) || empty($_GET['search']))
	$exec = $dao->listarSituacaoTorneio();
else
	$exec = $dao->pesquisarSituacaoTorneio($_GET['search']);

if(count($exec)>0){
foreach ($exec as $listar) {
	$opacity = "";
	$situacaoData = "";
	if($listar['situacao']=="Finalizado"){
		$opacity = "opacity";
		$situacaoData = " – ".$listar['termino_format'];
	}else if($listar['situacao']=="Não iniciado"){
		$situacaoData = " – ".$listar['inicio_format'];
	}
?>
<a class='tournament <?php echo $opacity?>' href='index.php?torneio=<?php echo $listar['id_torneio']; ?>&descricao=<?php echo $listar['descricao']; ?>'>
	<div class='tournament_title'>
		<label><?php echo $listar['descricao'];?></label>
		<label><?php echo $listar['situacao'].$situacaoData;?></label>
	</div>
</a>
<div class='tournament_line'></div>
<?php
 }
}else{ ?>
	<div class='error flex'>Nenhuma competição encontrada</div>
<?php } ?>