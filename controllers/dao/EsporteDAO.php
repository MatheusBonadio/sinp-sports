<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";

class EsporteDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($esporte){
		$sql = 'INSERT INTO esporte(id_torneio, esporte, genero, tipo, qtd_jogadores, qtd_times, classificacao, imagem) VALUES(:torneio, :esporte, :genero, :tipo, :qtdJogadores, :qtdTimes, :classificacao, :imagem)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $esporte->getIdTorneio());
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':qtdTimes', $esporte->getqtdTimes());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':imagem', $esporte->getImagem());
		$prep->execute();
	}

	public function listar($torneio){
		$sql = 'SELECT * FROM esporte WHERE id_torneio = :torneio order by tipo, esporte';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterarImagem($esporte){
		$sql = 'UPDATE esporte SET id_torneio = :torneio, esporte = :esporte, genero = :genero, tipo = :tipo, qtd_jogadores = :qtdJogadores, qtd_times = :qtdTimes, classificacao = :classificacao, imagem = :imagem WHERE id_esporte = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $esporte->getIdTorneio());
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':qtdTimes', $esporte->getqtdTimes());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':imagem', $esporte->getImagem());
		$prep->bindValue(':id', $esporte->getidEsporte());
		$prep->execute();
	}

	public function alterar($esporte){
		$sql = 'UPDATE esporte SET id_torneio = :torneio, esporte = :esporte, genero = :genero, tipo = :tipo, qtd_jogadores = :qtdJogadores, qtd_times = :qtdTimes, classificacao = :classificacao WHERE id_esporte = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $esporte->getIdTorneio());
		$prep->bindValue(':esporte', $esporte->getEsporte());
		$prep->bindValue(':genero', $esporte->getGenero());
		$prep->bindValue(':tipo', $esporte->getTipo());
		$prep->bindValue(':qtdJogadores', $esporte->getqtdJogadores());
		$prep->bindValue(':qtdTimes', $esporte->getqtdTimes());
		$prep->bindValue(':classificacao', $esporte->getClassificacao());
		$prep->bindValue(':id', $esporte->getidEsporte());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM esporte WHERE id_esporte = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $esporte = new Esporte();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$esporte->setidEsporte($linha['id_esporte']);
        	$esporte->setidTorneio($linha['id_torneio']);
	        $esporte->setEsporte($linha['esporte']);
	        $esporte->setGenero($linha['genero']);
	        $esporte->setTipo($linha['tipo']);
	        $esporte->setqtdJogadores($linha['qtd_jogadores']);
	        $esporte->setqtdTimes($linha['qtd_times']);
	        $esporte->setClassificacao($linha['classificacao']);
	        $esporte->setImagem($linha['imagem']);
        }
        return $esporte;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM esporte WHERE id_esporte = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function consultarTorneio(){
		$sql = "select id_torneio, descricao from torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}
}