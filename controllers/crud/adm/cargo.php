<?php
	session_start();
	session_write_close();
	include $_SERVER['DOCUMENT_ROOT'].'/painel/painel'.$_SESSION['cargo'].'.php';
?>
<div class='container_header flex'>Administrador</div>
<div class='container_body'>
<form action='formAdm.php' method='GET'>
	<select required name='cargo'>
		<option hidden disabled selected value=''>Selecione o cargo que deseja criar um administrador</option>
		<option>Gerente</option>
		<option>Administrador</option>
		<option>Representante</option>
	</select>
	<input type="submit" value='Enviar'>
</form>