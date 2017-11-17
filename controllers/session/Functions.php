<?php

class Functions{

	public function sessionGerente(){
		session_start();
		if(empty($_SESSION['login'])){
			header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'gerente'){
			header("refresh:0 url= ../errors/403.php");
		}
	}

	public function sessionAdm(){
		session_start();
		if(empty($_SESSION['login'])){
			header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'administrador'){
			if($_SESSION['cargo'] != 'gerente'){
				header("refresh:0 url= ../errors/403.php");
			}
		}
	}

	public function sessionRepresentante(){
		session_start();
		if(empty($_SESSION['login'])){
			header("refresh:0 url= ../errors/403.php");
		}

		if($_SESSION['cargo'] != 'administrador'){
			if($_SESSION['cargo'] != 'gerente'){
				if($_SESSION['cargo'] != 'representante')
				header("refresh:0 url= ../errors/403.php");
				}
			}
		}	
}