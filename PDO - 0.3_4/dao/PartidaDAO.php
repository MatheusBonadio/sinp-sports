<?php
	require_once '../../conexao.php';
	require_once '../../class/Partida.php';

class PartidaDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($partida){
		$sql = 'INSERT INTO partida(id_equipe_a, id_equipe_b, id_esporte, id_fase, id_torneio, dia, inicio) VALUES(:equipeA, :equipeB, :esporte, :fase, :torneio, :dia, :inicio)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':equipeA', $partida->getidEquipeA());
		$prep->bindValue(':equipeB', $partida->getidEquipeB());
		$prep->bindValue(':esporte', $partida->getidEsporte());
		$prep->bindValue(':fase', $partida->getidFase());
		$prep->bindValue(':torneio', $partida->getidTorneio());
		$prep->bindValue(':dia', $partida->getDia());
		$prep->bindValue(':inicio', $partida->getInicio());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as id_equipe_a, 
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as id_equipe_b, 
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio, dia, inicio, termino, placar_equipe_a, placar_equipe_b, vencedor FROM partida ORDER BY dia';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($partida){
		$sql = 'UPDATE partida SET id_esporte = :esporte, id_fase = :fase, id_torneio = :torneio, id_equipe_a = :equipeA, id_equipe_b = :equipeB, id_esporte = :esporte, dia = :dia, inicio = :inicio, termino = :termino, placar_equipe_a = :placarA, placar_equipe_b = :placarB, vencedor = :vencedor WHERE id_partida = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $partida->getidEsporte());
		$prep->bindValue(':fase', $partida->getidFase());
		$prep->bindValue(':torneio', $partida->getidTorneio());
		$prep->bindValue(':equipeA', $partida->getidEquipeA());
		$prep->bindValue(':equipeB', $partida->getidEquipeB());
		$prep->bindValue(':esporte', $partida->getidEsporte());
		$prep->bindValue(':fase', $partida->getidFase());
		$prep->bindValue(':dia', $partida->getDia());
		$prep->bindValue(':inicio', $partida->getInicio());
		$prep->bindValue(':termino', $partida->getTermino());
		$prep->bindValue(':placarA', $partida->getPlacarA());
		$prep->bindValue(':placarB', $partida->getPlacarB());
		$prep->bindValue(':vencedor', $partida->getVencedor());
		$prep->bindValue(':id', $partida->getidPartida());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM partida WHERE id_partida = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $partida = new Partida();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$partida->setidPartida($linha['id_partida']);
	        $partida->setidEquipeA($linha['id_equipe_a']);
	        $partida->setidEquipeB($linha['id_equipe_b']);
	        $partida->setidEsporte($linha['id_esporte']);
	        $partida->setidFase($linha['id_fase']);
	        $partida->setidTorneio($linha['id_torneio']);
	        $partida->setDia($linha['dia']);
	        $partida->setInicio($linha['inicio']);
	        $partida->setTermino($linha['termino']);
	        $partida->setPlacarA($linha['placar_equipe_a']);
	        $partida->setPlacarB($linha['placar_equipe_b']);
	        $partida->setVencedor($linha['vencedor']);
        }
        return $partida;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM partida WHERE id_partida = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
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

	public function consultarFase(){
		$sql = "select fase_indice, fase_descricao from fase order by fase_indice";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarTorneio(){
		$sql = "select id_torneio, descricao from torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarVencedor($id){
		$sql = "select id_equipe_a, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nomeA, id_equipe_b, (select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nomeB from partida where id_partida = :id";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':id', $id);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

}