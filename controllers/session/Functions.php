<?php

class Functions{

	public function sessionGerente(){
		if(empty($_SESSION['login'])){
			header('location: /error/403');
		}

		if($_SESSION['cargo'] != 'Gerente'){
			header('location: /error/403');
		}
	}

	public function sessionAdm(){
		if(empty($_SESSION['login'])){
			header('location: /error/403');
		}

		if($_SESSION['cargo'] != 'Administrador'){
			if($_SESSION['cargo'] != 'Gerente'){
				header('location: /error/403');
			}
		}
	}

	public function sessionRepresentante(){
		if(empty($_SESSION['login'])){
			header('location: /error/403');
		}

		if($_SESSION['cargo'] != 'Gerente'){
			if($_SESSION['cargo'] != 'Representante'){
				header('location: /error/403');
			}
		}
	}
}