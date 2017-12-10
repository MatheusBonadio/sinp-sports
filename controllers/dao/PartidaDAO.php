<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/class/Partida.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/class/Equipe.php";

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

	public function listar($torneio){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nome_equipe_a,
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nome_equipe_b,
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_a) as sigla_a,
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_b) as sigla_b,
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio,
		(select nome from equipe where equipe.id_equipe = partida.vencedor) as vencedor,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_a) as logo_a,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_b) as logo_b, 
		date_format(dia, "%d/%m/%Y") as dia_format, dia, inicio, termino, placar_equipe_a, placar_equipe_b, cast(replace(inicio,":","") as signed) as inicio_int FROM partida where id_torneio = :torneio ORDER BY dia, inicio_int';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarPartidasFinalizadas($torneio){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nome_equipe_a,
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nome_equipe_b,
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_a) as sigla_a,
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_b) as sigla_b,
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio,
		(select nome from equipe where equipe.id_equipe = partida.vencedor) as vencedor,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_a) as logo_a,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_b) as logo_b, dia, inicio,
		date_format(dia, "%d") as dia_format, date_format(dia, "%m") as mes_format, termino, placar_equipe_a, placar_equipe_b, cast(replace(inicio,":","") as signed) as inicio_int FROM partida where id_torneio = :torneio and vencedor IS NOT NULL ORDER BY dia desc, inicio_int desc';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarID($torneio, $id){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nome_equipe_a, 
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nome_equipe_b, 
		(select id_equipe from equipe where equipe.id_equipe = partida.id_equipe_a) as id_equipe_a, 
		(select id_equipe from equipe where equipe.id_equipe = partida.id_equipe_b) as id_equipe_b,
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_a) as sigla_a, 
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_b) as sigla_b, 
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as nome_esporte,
		(select id_esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select imagem from esporte where esporte.id_esporte = partida.id_esporte) as img_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio,
		(select nome from equipe where equipe.id_equipe = partida.vencedor) as vencedor,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_a) as logo_a,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_b) as logo_b,
		date_format(dia, "%d/%m/%Y") as dia, inicio, termino, placar_equipe_a, placar_equipe_b FROM partida where id_torneio = :torneio and id_partida = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':id', $id);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarEsporte($idEsporte, $torneio){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nome_equipe_a, 
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nome_equipe_b, 
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_a) as sigla_a, 
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_b) as sigla_b, 
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio,
		(select nome from equipe where equipe.id_equipe = partida.vencedor) as vencedor,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_a) as logo_a,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_b) as logo_b, dia, inicio, termino, placar_equipe_a, placar_equipe_b, cast(replace(inicio,":","") as signed) as inicio_int FROM partida where id_torneio = :torneio AND id_esporte = :idEsporte ORDER BY dia, inicio_int';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':idEsporte', $idEsporte);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarEquipe($idEquipe, $torneio){
		$sql = 'SELECT id_partida, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as nome_equipe_a, 
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as nome_equipe_b, 
		(select id_equipe from equipe where equipe.id_equipe = partida.id_equipe_a) as id_equipe_a, 
		(select id_equipe from equipe where equipe.id_equipe = partida.id_equipe_b) as id_equipe_b, 
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_a) as sigla_a, 
		(select sigla from equipe where equipe.id_equipe = partida.id_equipe_b) as sigla_b, 
		(select esporte from esporte where esporte.id_esporte = partida.id_esporte) as id_esporte,
		(select fase_descricao from fase where fase.fase_indice = partida.id_fase) as id_fase,
		(select descricao from torneio where torneio.id_torneio = partida.id_torneio) as id_torneio,
		(select nome from equipe where equipe.id_equipe = partida.vencedor) as vencedor,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_a) as logo_a,
		(select logo from equipe where equipe.id_equipe = partida.id_equipe_b) as logo_b, dia, inicio, termino, placar_equipe_a, placar_equipe_b, cast(replace(inicio,":","") as signed) as inicio_int FROM partida where id_torneio = :torneio and id_equipe_a = :idEquipe or id_equipe_b = :idEquipe ORDER BY dia, inicio_int';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':idEquipe', $idEquipe);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarEsportePartida($torneio){
		$sql = 'select distinct id_esporte, (select esporte from esporte where esporte.id_esporte = partida.id_esporte) as esporte from partida where id_torneio = :torneio order by esporte;';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function listarEquipePartida($torneio){
		$sql = 'select distinct id_equipe_a, (select nome from equipe where partida.id_equipe_a = equipe.id_equipe) as nome from partida where id_torneio = :torneio union select distinct id_equipe_b, (select nome from equipe where partida.id_equipe_b = equipe.id_equipe) as nome from partida where id_torneio = :torneio order by nome;';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	//edição

	public function listarParticipanteEsporte($torneio, $idEquipe, $idEsporte){
		$sql = 'select * from participante, participacao_esporte where participante.id_participante = participacao_esporte.id_participante and id_torneio = :torneio and id_equipe = :idEquipe and id_esporte = :idEsporte order by nome';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':idEquipe', $idEquipe);
		$prep->bindValue(':idEsporte', $idEsporte);
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

	public function consultarEquipeID($equipe, $torneio){
		$sql = "SELECT * FROM equipe WHERE id_equipe = :equipe AND id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':equipe', $equipe);
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
		$sql = "DELETE FROM partida WHERE id_partida = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function consultar($codigo, $torneio){
		$sql = "SELECT * FROM partida WHERE id_partida = :id AND id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->bindValue(':torneio', $torneio);
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

	public function consultarFase(){
		$sql = "select fase_indice, fase_descricao from fase order by fase_indice";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarEquipe($torneio){
		$sql = "select id_equipe, nome from equipe where id_torneio = :torneio order by nome";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarEsporte($torneio){
		$sql = "select id_esporte, esporte from esporte where id_torneio = :torneio";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarTorneio($torneio){
		$sql = "select id_torneio, descricao from torneio where id_torneio = :torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarVencedor($id, $torneio){
		$sql = "select id_equipe_a, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a and equipe.id_torneio = :torneio) as nomeA, id_equipe_b, (select nome from equipe where equipe.id_equipe = partida.id_equipe_b and equipe.id_torneio = :torneio) as nomeB from partida where id_partida = :id and partida.id_torneio = :torneio";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':id', $id);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function pontuacao($partida){
		$sql = 'UPDATE partida SET termino = :termino, placar_equipe_a = :placarA, placar_equipe_b = :placarB, vencedor = :vencedor WHERE id_partida = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':termino', $partida->getTermino());
		$prep->bindValue(':placarA', $partida->getPlacarA());
		$prep->bindValue(':placarB', $partida->getPlacarB());
		$prep->bindValue(':vencedor', $partida->getVencedor());
		$prep->bindValue(':id', $partida->getidPartida());
		$prep->execute();
	}

	public function consultarFasedeGrupo($idPartida){
		$sql = "select id_esporte, (select classificacao from esporte where partida.id_esporte = esporte.id_esporte) as classificacao from partida where id_partida = :partida";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':partida', $idPartida);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	if($linha['classificacao'] == 'Fase de Grupo'){
				return true;
			}else{
				return false;
			}
        }
	}

	public function consultarFasePartida($idPartida){
		$sql = "select id_fase, (select fase_indice from fase where fase.id_fase = partida.id_fase) as fase_indice from partida where id_partida = :partida";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':partida', $idPartida);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
	    $fase = '';
	    foreach ($exec as $linha) {
	    	$fase = $linha['fase_indice'];
		}
		return $fase;
	}

	public function consultarPontuacao($idEquipe, $idEsporte){
		$sql = "select * from classificacao where id_equipe = :equipe and id_esporte = :esporte";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':equipe', $idEquipe);
		$prep->bindValue(':esporte', $idEsporte);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		$pontuacao = '';
        foreach ($exec as $linha) {
        	$pontuacao = $linha['pontuacao'];
		}
		return $pontuacao;
    }
		
	public function inserirPontuacao($classificacao, $pontuacao){
		$sql = 'UPDATE classificacao SET pontuacao = :pontuacao WHERE id_classificacao = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':pontuacao', $pontuacao);
		$prep->bindValue(':id', $classificacao->getidClassificacao());
		$prep->execute();
	}

	public function consultarClassificacao($idEquipe, $idEsporte){
		$sql = "SELECT * FROM classificacao WHERE id_equipe = :equipe and id_esporte = :esporte";
        $prep = $this->con->prepare($sql);
		$prep->bindValue(':equipe', $idEquipe);
		$prep->bindValue(':esporte', $idEsporte);
		$prep->execute();
        $classificacao = new Classificacao();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$classificacao->setidClassificacao($linha['id_classificacao']);
        	$classificacao->setidTorneio($linha['id_torneio']);
	        $classificacao->setidEquipe($linha['id_equipe']);
	        $classificacao->setidEsporte($linha['id_esporte']);
	        $classificacao->setPontuacao($linha['pontuacao']);
        }
        return $classificacao;
	}

	public function inserirOuro($equipe, $ouro){
		$sql = 'UPDATE equipe SET ouro = :ouro WHERE id_equipe = :idEquipe';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':ouro', $ouro);
		$prep->bindValue(':idEquipe', $equipe);
		$prep->execute();
	}

	public function inserirPrata($equipe, $prata){
		$sql = 'UPDATE equipe SET prata = :prata WHERE id_equipe = :idEquipe';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':prata', $prata);
		$prep->bindValue(':idEquipe', $equipe);
		$prep->execute();
	}

	public function inserirBronze($equipe, $bronze){
		$sql = 'UPDATE equipe SET bronze = :bronze WHERE id_equipe = :idEquipe';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':bronze', $bronze);
		$prep->bindValue(':idEquipe', $equipe);
		$prep->execute();
	}
}