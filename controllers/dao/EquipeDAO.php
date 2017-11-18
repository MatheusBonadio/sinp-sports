<?php
	
require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/conexao.php";

class EquipeDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($equipe){
		$sql = 'INSERT INTO equipe(id_torneio, nome, sigla) VALUES(:torneio, :nome, :sigla)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $equipe->getidTorneio());
		$prep->bindValue(':nome', $equipe->getNome());
		$prep->bindValue(':sigla', $equipe->getSigla());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT * FROM equipe';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($equipe){
		$sql = 'UPDATE equipe SET id_torneio = :torneio, nome = :nome, sigla = :sigla, vitorias = :vitorias, empates = :empates, derrotas = :derrotas, pontos = :pontos WHERE id_equipe = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $equipe->getidTorneio());
		$prep->bindValue(':nome', $equipe->getNome());
		$prep->bindValue(':sigla', $equipe->getSigla());
		$prep->bindValue(':vitorias', $equipe->getVitorias());
		$prep->bindValue(':empates', $equipe->getEmpates());
		$prep->bindValue(':derrotas', $equipe->getDerrotas());
		$prep->bindValue(':pontos', $equipe->getPontos());
		$prep->bindValue(':id', $equipe->getidEquipe());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM equipe WHERE id_equipe = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $equipe = new Equipe();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $equipe->setidEquipe($linha['id_equipe']);
        	$equipe->setidTorneio($linha['id_torneio']);
	        $equipe->setNome($linha['nome']);
	        $equipe->setSigla($linha['sigla']);
	        $equipe->setVitorias($linha['vitorias']);
	        $equipe->setEmpates($linha['empates']);
	        $equipe->setDerrotas($linha['derrotas']);
	        $equipe->setPontos($linha['pontos']);
        }
        return $equipe;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM equipe WHERE id_equipe = :id";
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