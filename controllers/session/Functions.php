<?php

class Functions{

	public function sessionGerente(){
		if(empty($_SESSION['login'])){
			header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'Gerente'){
			header("refresh:0 url= ../errors/403.php");
		}
	}

	public function sessionAdm(){
		if(empty($_SESSION['login'])){
			header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'Administrador'){
			if($_SESSION['cargo'] != 'Gerente'){
				header("refresh:0 url= ../errors/403.php");
			}
		}
	}

	public function sessionRepresentante(){
		if(empty($_SESSION['login'])){
			//header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'Administrador'){
			if($_SESSION['cargo'] != 'Gerente'){
				if($_SESSION['cargo'] != 'Representante'){
					header("refresh:0 url= ../errors/403.php");
				}
			}
		}
	}
}