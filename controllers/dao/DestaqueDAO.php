<?php

require_once $_SERVER['DOCUMENT_ROOT']."/public_html/controllers/conexao.php";

class DestaqueDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($destaque){
		$sql = 'INSERT INTO destaque(id_partida, texto, imagem) VALUES(:idPartida, :texto, :imagem)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':idPartida', $destaque->getidPartida());
		$prep->bindValue(':texto', $destaque->getTexto());
		$prep->bindValue(':imagem', $destaque->getImagem());
		$prep->execute();
	}

	public function listar(){
		$sql = "SELECT *, (select esporte from esporte where esporte.id_esporte = partida.id_esporte) as esporte, (select tipo from esporte where esporte.id_esporte = partida.id_esporte) as tipo, date_format(partida.dia,'%d/%m/%Y') as dia FROM destaque,partida WHERE partida.id_partida = destaque.id_partida ORDER BY dia DESC, termino DESC, inicio DESC, id_destaque DESC LIMIT 6";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterarImagem($destaque){
		$sql = 'UPDATE destaque SET id_partida = :idPartida, texto = :texto, imagem = :imagem WHERE id_destaque = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':idPartida', $destaque->getidPartida());
		$prep->bindValue(':texto', $destaque->getTexto());
		$prep->bindValue(':imagem', $destaque->getImagem());
		$prep->bindValue(':id', $destaque->getidDestaque());
		$prep->execute();
	}

	public function alterar($destaque){
		$sql = 'UPDATE destaque SET id_partida = :idPartida, texto = :texto WHERE id_destaque = :id';
		$prep = $this->con->prepare($sql);
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

	public function consultarPartida(){
		$sql = "SELECT id_partida, id_esporte, date_format(partida.dia, '%d/%m/%Y') AS dia, (select esporte from esporte where esporte.id_esporte = partida.id_esporte) AS esporte, (select nome from equipe where equipe.id_equipe = partida.id_equipe_a) as equipe_a, 
		(select nome from equipe where equipe.id_equipe = partida.id_equipe_b) as equipe_b FROM partida";
		$prep = $this->con->prepare($sql);
        $prep->execute();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        return $exec;
	}
}
	
	