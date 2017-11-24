<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";

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

	public function normalizaURL($descricao){
	    $descricao = strtolower(utf8_decode($descricao)); $i=1;
	    $descricao = strtr($descricao, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
	    $descricao = preg_replace("/([^a-z0-9])/",'-',utf8_encode($descricao));
	    while($i>0) $descricao = str_replace('--','-',$descricao,$i);
	    if (substr($descricao, -1) == '-') $descricao = substr($descricao, 0, -1);
	    return $descricao;
	}
}