<?php

require_once $_SERVER['DOCUMENT_ROOT']."/controllers/conexao.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controllers/class/Administrador.php";

class AdministradorDAO{

	private $con;

	public function __construct(){
		$conexao = new Conexao();
		$this->con = $conexao->getConexao();
	}	

	public function inserir($adm){
		$sql = 'INSERT INTO administrador(id_torneio, login, senha, email, nome, cargo) VALUES(:torneio, :login, :senha, :email, :nome, :cargo)';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $adm->getidTorneio());
		$prep->bindValue(':login', $adm->getLogin());
		$prep->bindValue(':senha', $adm->getSenha());
		$prep->bindValue(':email', $adm->getEmail());
		$prep->bindValue(':nome', $adm->getNome());
		$prep->bindValue(':cargo',$adm->getCargo());
		$prep->execute();
	}

	public function listar($torneio){
		$sql = 'SELECT *,(select descricao from torneio where administrador.id_torneio = torneio.id_torneio) as descricao FROM administrador WHERE id_torneio = :torneio order by field(cargo, "Gerente", "Administrador", "Representante"), nome';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}
	
	public function alterar($adm){
		$sql = 'UPDATE administrador SET id_torneio = :torneio, login = :login, senha = :senha, email = :email, nome = :nome WHERE id_adm = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $adm->getidTorneio());
		$prep->bindValue(':login', $adm->getLogin());
		$prep->bindValue(':senha', $adm->getSenha());
		$prep->bindValue(':email', $adm->getEmail());
		$prep->bindValue(':nome', $adm->getNome());
		$prep->bindValue(':id', $adm->getidAdm());
		$prep->execute();
	}

	public function alterarCargo($adm){
		$sql = 'UPDATE administrador SET cargo = :cargo WHERE id_adm = :id';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':cargo', $adm->getCargo());
		$prep->bindValue(':id', $adm->getidAdm());
		$prep->execute();
	}

	public function trocarSenha($senha, $login, $torneio){
		$sql = 'UPDATE administrador SET senha = :senha WHERE id_torneio = :torneio and login = :login';
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->bindValue(':login', $login);
		$prep->bindValue(':senha', $senha);
		$prep->execute();
	}

	public function consultar($codigo){
		$sql = "SELECT * FROM administrador WHERE id_adm = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
        $adm = new Administrador();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$adm->setidAdm($linha['id_adm']);
	        $adm->setidTorneio($linha['id_torneio']);
	        $adm->setLogin($linha['login']);
	        $adm->setSenha($linha['senha']);
	        $adm->setEmail($linha['email']);
	        $adm->setNome($linha['nome']);
	        $adm->setCargo($linha['cargo']);
        }
        return $adm;
	}

	public function consultarLogin($login, $torneio){
		$sql = "SELECT * FROM administrador WHERE login = :login and id_torneio = :torneio";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':login', $login);
        $prep->bindValue(':torneio', $torneio);
        $prep->execute();
        $adm = new Administrador();
        $exec = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exec as $linha) {
        	$adm->setidAdm($linha['id_adm']);
	        $adm->setidTorneio($linha['id_torneio']);
	        $adm->setLogin($linha['login']);
	        $adm->setSenha($linha['senha']);
	        $adm->setEmail($linha['email']);
	        $adm->setNome($linha['nome']);
	        $adm->setCargo($linha['cargo']);
        }
        return $adm;
	}

	public function excluir($codigo){
		$sql = "DELETE FROM administrador WHERE id_adm = :id";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':id', $codigo);
        $prep->execute();
	}

	public function consultarEsporte($torneio){
 		$sql = "select id_esporte, esporte from esporte where id_torneio = :torneio order by tipo,esporte";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function consultarPermissao($login){
 		$sql = "select permissao.id_esporte, esporte from esporte, permissao where permissao.login = :login and permissao.id_esporte = esporte.id_esporte order by tipo,esporte;";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
 	}

 	public function consultarNumPermissao($login){
 		$sql = "select permissao.id_esporte from esporte, permissao where permissao.login = :login and permissao.id_esporte = esporte.id_esporte order by tipo,esporte;";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->execute();
		return $prep->rowCount();
 	}

	public function inserirPermissao($adm, $permissao){
		for($i=0;$i<count($permissao);$i++){
			$sql = "insert into permissao(login, id_torneio, id_esporte) values(:login, :torneio, :permissao);";
			$prep = $this->con->prepare($sql);
			$prep->bindValue(':login', $adm->getLogin());
			$prep->bindValue(':torneio', $adm->getidTorneio());
			$prep->bindValue(':permissao', $permissao[$i]);
	        $prep->execute();
		}
	}

 	public function excluirPermissao($login){
		$sql = "DELETE FROM permissao WHERE login = :login";
        $prep = $this->con->prepare($sql);
        $prep->bindValue(':login', $login);
        $prep->execute();
	}

	public function consultarTorneio(){
		$sql = "select id_torneio, descricao from torneio order by descricao";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarTorneioID($id){
		$sql = "select id_torneio, descricao from torneio where id_torneio = :id";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':id', $id);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach ($exec as $linha) {
			$idTorneio = $linha['id_torneio'];
		}
		return $idTorneio;
	}

	public function verificarLogin($login, $senha, $torneio){
		$sql = "select * from administrador where login = :login and senha = :senha and id_torneio = :torneio";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->bindValue(':senha', $senha);
		$prep->bindValue(':torneio', $torneio);
		$prep->execute();
		if($prep->fetchColumn() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function verificarGerente($login, $senha){
		$sql = "select * from administrador where login = :login and senha = :senha and cargo = 'Gerente'";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->bindValue(':senha', $senha);
		$prep->execute();
		if($prep->fetchColumn() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function consultarCargo(){
		$sql = "select cargo from administrador";
		$prep = $this->con->prepare($sql);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		return $exec;
	}

	public function consultarCargoLogin($login){
		$sql = "select cargo from administrador where login = :login";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($exec as $linha){
			$cargo = $linha['cargo'];
		}
		return $cargo;
	}

	public function consultarNomeLogin($login){
		$sql = "select nome from administrador where login = :login";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':login', $login);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($exec as $linha){
			$nome = $linha['nome'];
		}
		return $nome;
	}

	public function consultarSenhaAntiga($id){
		$sql = "select senha from administrador where id_adm = :id";
		$prep = $this->con->prepare($sql);
		$prep->bindValue(':id', $id);
		$prep->execute();
		$exec = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($exec as $linha){
			$senhaAntiga = $linha['senha'];
		}
		return $senhaAntiga;
	}
}