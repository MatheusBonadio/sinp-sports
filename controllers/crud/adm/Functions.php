<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/conexao.php';

class Functions{

	private $con;
	private $arrayCargo = ['Gerente','Representante','Administrador'];

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

	public function optionsCargo($adm){
		echo "<option selected disabled hidden>Selecione um cargo</option>";
		for($i=0;$i<count($this->arrayCargo);$i++){
			if($this->arrayCargo[$i]==$adm->getCargo())
				echo "<option selected>".$this->arrayCargo[$i]."</option>";
			else
				echo "<option>".$this->arrayCargo[$i]."</option>";
		}	
	}
}