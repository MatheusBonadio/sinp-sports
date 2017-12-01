 <?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/class/Participante.php";

class ParticipanteDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($participante){
		$sql = 'INSERT INTO participante(id_torneio, id_equipe, nome) VALUES(:torneio, :equipe, :nome)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $participante->getidTorneio());
		$prep->bindValue(':equipe', $participante->getidEquipe());
		$prep->bindValue(':nome', $participante->getNome());
		$prep->execute();
	}

	public function listar($torneio){
		$sql = 'SELECT *,(select nome from equipe where equipe.id_equipe = participante.id_equipe) as nome_equipe FROM participante WHERE id_torneio = :torneio order by nome_equipe, nome';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($participante){
		$sql = 'UPDATE participante SET id_torneio = :torneio, id_equipe = :equipe, nome = :nome WHERE id_participante = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $participante->getidTorneio());
		$prep->bindValue(':equipe', $participante->getidEquipe());
		$prep->bindValue(':nome', $participante->getNome());
		$prep->bindValue(':id', $participante->getidParticipante());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM participante WHERE id_participante = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $participante = new Participante();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $participante->setidParticipante($linha['id_participante']);
	        $participante->setidTorneio($linha['id_torneio']);
	        $participante->setidEquipe($linha['id_equipe']);
	        $participante->setNome($linha['nome']);
        }
        return $participante;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM participante WHERE id_participante = :id";
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

	public function consultarEsporte($torneio){
 		$sql = "select id_esporte, esporte from esporte where id_torneio = :torneio order by tipo,esporte";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function consultarEsporteID($torneio, $idEsporte){
 		$sql = "select id_esporte, esporte from esporte where id_torneio = :torneio and id_esporte = :idEsporte order by tipo,esporte";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':idEsporte', $idEsporte);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function consultarParticipacao($idParticipante){
 		$sql = "select esporte, participacao_esporte.id_esporte from esporte, participacao_esporte where participacao_esporte.id_participante = :idParticipante and participacao_esporte.id_esporte = esporte.id_esporte order by tipo,esporte;";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':idParticipante', $idParticipante);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function inserirParticipacao($participante, $esporte){
		for($i=0;$i<count($participante);$i++){
			$sql = "insert into participacao_esporte(id_participante, id_esporte) values(:id_participante, :esporte);";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':id_participante', $participante[$i]);
			$prep->bindValue(':esporte', $esporte);
	        $prep->execute();
		}
	}

	public function inserirParticipacaoEsporte($participante, $esporte){
		for($i=0;$i<count($esporte);$i++){
			$sql = "insert into participacao_esporte(id_participante, id_esporte) values(:id_participante, :esporte);";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':id_participante', $participante);
			$prep->bindValue(':esporte', $esporte[$i]);
	        $prep->execute();
		}
	}

	public function excluirParticipacao($idParticipante){
		$sql = "DELETE FROM participacao_esporte WHERE id_participante = :idParticipante";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idParticipante', $idParticipante);
        $prep->execute();
	}

	public function excluirParticipacaoEsporte($idParticipante, $idEsporte){
		$sql = "DELETE FROM participacao_esporte WHERE id_participante = :idParticipante and id_esporte = :idEsporte";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idParticipante', $idParticipante);
        $prep->bindValue(':idParticipante', $idEsporte);
        $prep->execute();
	}

	public function consultarEquipeRepre($representante, $torneio){
		$sql = "SELECT * FROM equipe WHERE representante = :id and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $representante);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $idEquipe = $linha['id_equipe'];
        }
        return $idEquipe;
	}

	public function consultarQtdJogadores($torneio, $idEsporte){
		$sql = "SELECT qtd_jogadores FROM esporte WHERE id_esporte = :idEsporte and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idEsporte', $idEsporte);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $qtdJogadores = $linha['qtd_jogadores'];
        }
        return $qtdJogadores;
	}

	public function consultarQtdTimes($torneio, $idEsporte){
		$sql = "SELECT qtd_times FROM esporte WHERE id_esporte = :idEsporte and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idEsporte', $idEsporte);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $qtdTimes = $linha['qtd_times'];
        }
        return $qtdTimes;
	}

	public function consultarRegistrosEsporte($torneio, $idEsporte){
		$sql = "SELECT * FROM participacao_esporte WHERE id_esporte = :idEsporte";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idEsporte', $idEsporte);
        $prep->execute();
        if(($prep->rowCount()) > 0){
        	return true;
        }else{
        	return false;
        }  
	}

	public function consultarEquipe($torneio){
		$sql = "select id_equipe, nome from equipe where id_torneio = :torneio order by nome";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

}