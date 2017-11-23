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

	public function listar(){
		$sql = 'SELECT * FROM participante';
		$prep = $this->con->prepare($sql);
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

	public function consultarEquipe(){
		$sql = "select id_equipe, nome from equipe order by nome";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarEsporte(){
 		$sql = "select id_esporte, esporte from esporte order by tipo,esporte";
		$prep = $this->con->prepare($sql);
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

 	public function inserirParticipacao($participante, $participacao){
		for($i=0;$i<count($participacao);$i++){
			$sql = "insert into participacao_esporte(id_participante, id_torneio, id_esporte) values(:id_participante, :torneio, :participacao);";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':id_participante', $participante->getidParticipante());
			$prep->bindValue(':torneio', $participante->getidTorneio());
			$prep->bindValue(':participacao', $participacao[$i]);
	        $prep->execute();
		}
	}

	public function excluirParticipacao($idParticipante){
		$sql = "DELETE FROM participacao_esporte WHERE id_participante = :idParticipante";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':idParticipante', $idParticipante);
        $prep->execute();
	}
}