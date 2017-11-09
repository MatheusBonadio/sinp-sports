<?php
require_once '../../conexao.php';

class Functions{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

 	public function selectEsporte(){
 		$sql = "select id_esporte, esporte from esporte order by tipo,esporte";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}	
}