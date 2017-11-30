<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";

class DestaqueDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($destaque){
		$sql = 'INSERT INTO destaque(id_torneio, id_partida, texto, imagem) VALUES(:torneio, :idPartida, :texto, :imagem)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $destaque->getidTorneio());
		$prep->bindValue(':idPartida', $destaque->getidPartida());
		$prep->bindValue(':texto', $destaque->getTexto());
		$prep->bindValue(':imagem', $destaque->getImagem());
		$prep->execute();
	}

	public function listar($torneio){
		$sql = "SELECT *, (select esporte from esporte where esporte.id_esporte = partida.id_esporte and esporte.id_torneio = :torneio) as esporte, (select tipo from esporte where esporte.id_esporte = partida.id_esporte and esporte.id_torneio = :torneio) as tipo, date_format(partida.dia,'%d/%m/%Y') as dia, (select id_torneio from torneio where torneio.id_torneio = destaque.id_torneio) as id_torneio FROM destaque,partida WHERE partida.id_partida = destaque.id_partida AND destaque.id_torneio = :torneio ORDER BY dia DESC, termino DESC, inicio DESC, id_destaque DESC LIMIT 6";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	//TERMINA AQUI

	public function listarEsporte($idEsporte, $torneio, $idPartida){
		$sql = "SELECT *, (select esporte from esporte where id_esporte = :esporte and id_torneio = :torneio) as esporte, (SELECT id_partida FROM partida WHERE partida.id_esporte = :esporte AND destaque.id_partida = partida.id_partida AND partida.id_torneio = :torneio) FROM destaque WHERE id_torneio = :torneio AND id_partida = :partida";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $idEsporte);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':partida', $idPartida);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterarImagem($destaque){
		$sql = 'UPDATE destaque SET id_torneio = :torneio, id_partida = :idPartida, texto = :texto, imagem = :imagem WHERE id_destaque = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $destaque->getidTorneio());
		$prep->bindValue(':idPartida', $destaque->getidPartida());
		$prep->bindValue(':texto', $destaque->getTexto());
		$prep->bindValue(':imagem', $destaque->getImagem());
		$prep->bindValue(':id', $destaque->getidDestaque());
		$prep->execute();
	}

	public function alterar($destaque){
		$sql = 'UPDATE destaque SET id_torneio = :torneio, id_partida = :idPartida, texto = :texto WHERE id_destaque = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $destaque->getidTorneio());
		$prep->bindValue(':idPartida', $destaque->getidPartida());
		$prep->bindValue(':texto', $destaque->getTexto());
		$prep->bindValue(':id', $destaque->getidDestaque());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM destaque WHERE id_destaque = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $destaque = new Destaque();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$destaque->setidDestaque($linha['id_destaque']);
        	$destaque->setidTorneio($linha['id_torneio']);
	        $destaque->setidPartida($linha['id_partida']);
	        $destaque->setTexto($linha['texto']);
	        $destaque->setImagem($linha['imagem']);
        }
        return $destaque;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM destaque WHERE id_destaque = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function consultarPartida($idEsporte, $torneio){
		$sql = "SELECT id_partida, id_esporte, date_format(partida.dia, '%d/%m/%Y') AS dia, (select esporte from esporte where esporte.id_esporte = partida.id_esporte) AS esporte, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as equipe_a, (select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as equipe_b FROM partida WHERE id_esporte = :esporte AND id_torneio = :torneio";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':esporte', $idEsporte);
		$prep->bindValue(':torneio', $torneio);
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
}
	
	