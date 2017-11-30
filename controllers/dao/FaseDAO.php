 <?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/class/Fase.php";

class FaseDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($fase){
		$sql = 'INSERT INTO fase(fase_descricao, fase_indice) VALUES( :descricao, :indice)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':descricao', $fase->getDescricao());
		$prep->bindValue(':indice', $fase->getIndice());
		$prep->execute();
	}

	public function listar(){
		$sql = 'SELECT * FROM fase';
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function alterar($fase){
		$sql = 'UPDATE fase SET fase_descricao = :descricao, fase_indice = :indice WHERE id_fase = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':descricao', $fase->getDescricao());
		$prep->bindValue(':indice', $fase->getIndice());
		$prep->bindValue(':id', $fase->getidFase());
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM fase WHERE id_fase = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $fase = new Fase();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
	        $fase->setidFase($linha['id_fase']);
	        $fase->setDescricao($linha['fase_descricao']);
	        $fase->setIndice($linha['fase_indice']);
        }
        return $fase;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM fase WHERE id_fase = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}
}