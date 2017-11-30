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

	public function excluirAdm($torneio){
		$sql = "SELECT * FROM administrador WHERE id_torneio = :torneio AND cargo = 'Administrador' OR cargo = 'Representante'";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $sql = "DELETE FROM administrador WHERE id_adm = :id";
	       	$prep = $this->con->prepare($sql);
	        $prep->bindValue(':id', $linha['id_adm']);
	        $prep->execute();

	        $sql = "DELETE FROM permissao WHERE login = :login";
        	$prep = $this->con->prepare($sql);
        	$prep->bindValue(':login', $linha['login']);
        	$prep->execute();
        }
	}

	public function excluirDestaque($codigo){
		$sql = "DELETE FROM destaque WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function excluirEquipe($codigo){
		$sql = "DELETE FROM equipe WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function excluirEsporte($codigo){
		$sql = "DELETE FROM esporte WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function excluirPartida($codigo){
		$sql = "DELETE FROM partida WHERE id_torneio = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function excluirParticipante($torneio){
		$sql = "SELECT * FROM participante WHERE id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
		    $sql = "DELETE FROM participante WHERE id_participante = :id";
	        $prep = $this->con->prepare($sql);
	        $prep->bindValue(':id', $linha['id_participante']);
	        $prep->execute();

		    $sql = "DELETE FROM participacao_esporte WHERE id_participante = :idParticipante";
	        $prep = $this->con->prepare($sql);
	        $prep->bindValue(':idParticipante', $linha['id_participante']);
	        $prep->execute();
        }
	}

	public function excluirClassificacao($codigo){
		$sql = "DELETE FROM classificacao WHERE id_torneio = :id";
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

	public function listarSituacaoTorneio(){
		$sql = 'SELECT *, date_format(inicio, "%d/%m/%Y") as inicio_format, date_format(termino, "%d/%m/%Y") as termino_format, (case when inicio <= curdate() and termino >= curdate() then "Em andamento" when termino <= curdate() then "Finalizado" else "Não iniciado" end) as situacao FROM torneio order by field(situacao, "Em andamento", "Não iniciado", "Finalizado"), termino desc, descricao';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function pesquisarSituacaoTorneio($pesquisa){
		$sql = 'SELECT *, date_format(inicio, "%d/%m/%Y") as inicio_format, date_format(termino, "%d/%m/%Y") as termino_format, (case when inicio <= curdate() and termino >= curdate() then "Em andamento" when termino <= curdate() then "Finalizado" else "Não iniciado" end) as situacao FROM torneio where descricao like :pesquisa order by field(situacao, "Em andamento", "Não iniciado", "Finalizado"), termino desc, descricao';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':pesquisa', "%".$pesquisa."%");
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}
}