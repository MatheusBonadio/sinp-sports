<?php
require_once 'class.smtp.php';
require_once 'class.phpmailer.php';

class Mail{

	public function gerarSenha(){
	    $elementos = 'abcdefghijklmnopqrstuvwxyz0123456789';
	    $max = strlen($elementos) - 1;
	    $senha = null;
	    for($i=0;$i < 8; $i++)
	        $senha .= $elementos{mt_rand(0,$max)};
	    return $senha;
	}

	public function configurarEmail($nome, $email, $senha, $login){
		$Mailer = new PHPMailer;
		$Mailer->CharSet = "UTF-8";
		$Mailer->IsSMTP();
		$Mailer->Host = "smtp-mail.outlook.com";
		$Mailer->SMTPAuth = true;
		$Mailer->Username = "sinpsports@outlook.com";
		$Mailer->Password = "p13m28m29";
		$Mailer->SMTPSecure = "tls";
		$Mailer->Port = 587;
		$Mailer->FromName = "{$nome}";
		$Mailer->From = "sinpsports@outlook.com";
		$Mailer->AddAddress("{$email}");
		$Mailer->IsHTML(true);
		$Mailer->Subject = "Senha definida - {$nome}"." - ".date("d/m/Y");
		$Mailer->Body = "<body style='margin: 0; padding: 0;'>
						 	<table align='center' width='100%' style='border-collapse: collapse;border: 1px solid #ccc;font-family: Arial;border-radius: 3px;'>
						 		<tr>
						 			<td style='background: url(http://sinpsports.com/public/img/sistema/header.gif) no-repeat center;background-size: cover' height='270'></td>
						 		</tr>
						 		<tr>
						 			<td style='padding: 40px 30px 40px 30px;text-align: justify;'>
										Olá {$nome}! Você acaba de ser qualificado(a) para a administração da competição esportiva – ".$_SESSION['descricao2'].".
										<br><br>
										login: <strong>{$login}</strong><br>
										senha: <strong>{$senha}</strong>
										<br><br>
										Att, gerencia Sinp Sports.
						 			</td>
						 		</tr>
						  		<tr style='background-color: #000;color: #fff'>
						  			<td style='padding: 25px;text-align: center;'>© Copyright - Todos os direitos reservados</td>
						  		</tr>
						 	</table>
						</body>";
		if(!$Mailer->send()) {
		    echo 'Message could not be sent.<br>';
		    echo 'Mailer Error: ' . $Mailer->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
		header('location: selectAdm.php');
	}
}