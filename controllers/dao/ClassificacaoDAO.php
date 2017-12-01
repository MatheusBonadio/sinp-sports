<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";

class ClassificacaoDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($torneio){
		$sqlEquipe = "SELECT * FROM equipe WHERE id_torneio = :torneio";
		$prep = $this->con->prepare($sqlEquipe);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$execEquipe = $prep->fetchAll(PDO::FETCH_ASSOC);

		foreach ($execEquipe as $linhaEquipe) {
		
			$sqlEsporte = "SELECT * FROM esporte WHERE id_torneio = :torneio AND classificacao = 'Fase de Grupo'";
			$prep = $this->con->prepare($sqlEsporte);
			$prep->bindValue(':torneio', $torneio);
			$prep->execute();
			$execEsporte = $prep->fetchAll(PDO::FETCH_ASSOC);

				foreach ($execEsporte as $linhaEsporte) {
					$sql = "INSERT INTO classificacao(id_torneio, id_equipe, id_esporte) VALUES(:torneio, :idEquipe, :idEsporte)";
			        $prep = $this->con->prepare($sql);
			        $prep->bindValue(':idEsporte', $linhaEsporte['id_esporte']);
			        $prep->bindValue(':idEquipe', $linhaEquipe['id_equipe']);
			        $prep->bindValue(':torneio', $torneio);
			        $prep->execute();
	        	}
        }
	}

	public function listar($torneio){
		$sql = "SELECT *, (select nome from equipe where classificacao.id_equipe = equipe.id_equipe) as nomeEquipe, (select esporte from esporte where classificacao.id_esporte = esporte.id_esporte) as nomeEsporte, (select descricao from torneio where classificacao.id_torneio = torneio.id_torneio) FROM classificacao WHERE id_torneio = :torneio order by nomeEsporte, pontuacao desc, nomeEquipe";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM classificacao WHERE id_classificacao = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}
}