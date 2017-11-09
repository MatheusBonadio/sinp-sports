<?php

class Functions{

	private $arrayGenero = ['Ambos','Feminino','Masculino'];
	private $arrayTipo = ['Físico','Tabuleiro','Eletrônico'];
	private $arrayClassifi = ['Chave','Fase de Grupo'];

	public function optionsGenero($esporte){
		echo "<option selected disabled hidden>Selecione um gênero</option>";
		for($i=0;$i<count($this->arrayGenero);$i++){
			if($this->arrayGenero[$i]==$esporte->getGenero())
				echo "<option selected>".$this->arrayGenero[$i]."</option>";
			else
				echo "<option>".$this->arrayGenero[$i]."</option>";
		}
	}

	public function optionsTipo($esporte){
		echo "<option selected disabled hidden>Selecione um tipo</option>";
		for($i=0;$i<count($this->arrayTipo);$i++){
			if($this->arrayTipo[$i]==$esporte->getTipo())
				echo "<option selected>".$this->arrayTipo[$i]."</option>";
			else
				echo "<option>".$this->arrayTipo[$i]."</option>";
		}
	}

	public function optionsClassificacao($esporte){
		echo "<option selected disabled hidden>Selecione uma classificacao</option>";
		for($i=0;$i<count($this->arrayClassifi);$i++){
			if($this->arrayClassifi[$i]==$esporte->getClassificacao())
				echo "<option selected>".$this->arrayClassifi[$i]."</option>";
			else
				echo "<option>".$this->arrayClassifi[$i]."</option>";
		}
	}
}
?>