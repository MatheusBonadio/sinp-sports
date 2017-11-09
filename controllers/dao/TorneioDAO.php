<?php

require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/conexao.php";

class TorneioDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($torneio){
		$sql = 'INSERT INTO torneio(descricao, inicio, termino) VALUES(:descricao, :inicio, :termino)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':descricao', $torneio->getDescricao());
		$prep->bindValue(':inicio', $torneio->getInicio());
		$prep->bindValue(':termino', $torneio->getTermino());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT * FROM torneio';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($torneio){
		$sql = 'UPDATE torneio SET descricao = :descricao, inicio = :inicio, termino = :termino WHERE id_torneio = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':descricao', $torneio->getDescricao());
		$prep->bindValue(':inicio', $torneio->getInicio());
		$prep->bindValue(':termino', $torneio->getTermino());
		$prep->bindValue(':id', $torneio->getidTorneio());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM torneio WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $torneio = new Torneio();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $torneio->setidTorneio($linha['id_torneio']);
	        $torneio->setDescricao($linha['descricao']);
	        $torneio->setInicio($linha['inicio']);
	        $torneio->setTermino($linha['termino']);
        }
        return $torneio;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM torneio WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}
}