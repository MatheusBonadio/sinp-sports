<?php
	
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";

class EquipeDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($equipe){
		$sql = 'INSERT INTO equipe(id_torneio, nome, sigla, representante, logo) VALUES(:torneio, :nome, :sigla, :representante, :logo)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $equipe->getidTorneio());
		$prep->bindValue(':nome', $equipe->getNome());
		$prep->bindValue(':sigla', $equipe->getSigla());
		$prep->bindValue(':representante', $equipe->getRepresentante());
		$prep->bindValue(':logo', $equipe->getLogo());
		$prep->execute();
	}

	public function listar($torneio){
		$sql = 'SELECT *,(ouro*50+prata*30+bronze*20) as pontos FROM equipe WHERE id_torneio = :torneio order by pontos desc, nome';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarEquipeRepre($representante, $torneio){
		$sql = 'SELECT *,(ouro*50+prata*30+bronze*20) as pontos FROM equipe WHERE representante = :representante and id_torneio = :torneio';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':representante', $representante);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($equipe){
		$sql = 'UPDATE equipe SET nome = :nome, sigla = :sigla WHERE id_equipe = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':nome', $equipe->getNome());
		$prep->bindValue(':sigla', $equipe->getSigla());
		$prep->bindValue(':id', $equipe->getidEquipe());
		$prep->execute();
	}

	public function alterarLogo($equipe){
		$sql = 'UPDATE equipe SET nome = :nome, sigla = :sigla, logo = :logo WHERE id_equipe = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':nome', $equipe->getNome());
		$prep->bindValue(':sigla', $equipe->getSigla());
		$prep->bindValue(':logo', $equipe->getLogo());
		$prep->bindValue(':id', $equipe->getidEquipe());
		$prep->execute();
	}

	public function consultar($codigo, $torneio){
		$sql = "SELECT * FROM equipe WHERE id_equipe = :id and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $equipe = new Equipe();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $equipe->setidEquipe($linha['id_equipe']);
        	$equipe->setidTorneio($linha['id_torneio']);
	        $equipe->setNome($linha['nome']);
	        $equipe->setSigla($linha['sigla']);
	        $equipe->setOuro($linha['ouro']);
	        $equipe->setPrata($linha['prata']);
	        $equipe->setBronze($linha['bronze']);
	        $equipe->setPontos($linha['pontos']);
	        $equipe->setRepresentante($linha['representante']);
	        $equipe->setLogo($linha['logo']);
        }
        return $equipe;
	}

	public function consultarEquipeRepre($representante, $torneio){
		$sql = "SELECT * FROM equipe WHERE representante = :id and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $representante);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $equipe = new Equipe();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $equipe->setidEquipe($linha['id_equipe']);
        	$equipe->setidTorneio($linha['id_torneio']);
	        $equipe->setNome($linha['nome']);
	        $equipe->setSigla($linha['sigla']);
	        $equipe->setOuro($linha['ouro']);
	        $equipe->setPrata($linha['prata']);
	        $equipe->setBronze($linha['bronze']);
	        $equipe->setPontos($linha['pontos']);
	        $equipe->setRepresentante($linha['representante']);
	        $equipe->setLogo($linha['logo']);
        }
        return $equipe;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM equipe WHERE id_equipe = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function excluirRepresentante($login, $torneio){
		$sql = "DELETE FROM administrador WHERE login = :login and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':login', $login);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
	}

	public function excluirParticipante($exec){
		 foreach ($exec as $linha) {
	        $sql = "DELETE FROM participante WHERE id_participante = :codigo";
	        $prep = $this->con->prepare($sql);
	        $prep->bindValue(':codigo', $linha['id_participante']);
	        $prep->execute();
        }
		
	}

	public function excluirParticipacao($codigo){
		 foreach ($exec as $linha) {
	        $sql = "DELETE FROM participacao_esporte WHERE id_participante = :codigo";
	        $prep = $this->con->prepare($sql);
	        $prep->bindValue(':codigo', $linha['id_participante']);
	        $prep->execute();
        }
	}

	public function consultarTorneio(){
		$sql = "select id_torneio, descricao from torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarRepresentantes($torneio){
		$sql = "SELECT * FROM administrador WHERE cargo = 'Representante' and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarParticipantes($equipe, $torneio){
		$sql = "SELECT * FROM participante WHERE id_equipe = :equipe and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':equipe', $equipe);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function inserirClassificacao($torneio){
		$sqlEquipe = "SELECT * FROM equipe WHERE id_torneio = :torneio";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $execEquipe;

		foreach ($execEquipe as $linhaEquipe) {
		

			$sqlEsporte = "SELECT * FROM esporte WHERE id_torneio = :torneio AND classificacao = 'Fase de Grupo'";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':torneio', $torneio);
			$prep->execute();
			$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
			return $execEsporte;

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
}