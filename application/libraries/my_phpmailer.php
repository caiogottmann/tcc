<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_PHPMailer {
    //MY_ para informar ao framework de que se trata de uma classe customizada, ou seja, não faz parte do framework. Pode ser alterada no arquivo config.php em application/config/
    public function My_PHPMailer() {
        require_once('PHPMailer/PHPMailerAutoload.php');
    }

    public function My_EnviarEmail($email, $nome, $url)
{
	$this->My_PHPMailer();
    $mail = new PHPMailer();
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;   
	$mail->From = '';
	$mail->FromName = 'Equipe RSC';
	$mail->CharSet = 'UTF-8';
	$mail->addAddress($email, $nome);     
	$mail->addReplyTo('', 'RSC');
	$mail->isHTML(true);  
	$mail->Subject = 'URL';
	$mail->Body    = '

<table border="2" style="width:50%; border: 1px solid blue; border-collapse: collapse;">
      <tr>
        <td>
          <h2>Sr.(a) '.$nome.',</h2> <p>Para maior segurança, você deve acessar o link neste email para prosseguir com o processo de recuperação de senha.<p>
          <center>Para prosseguir, acesse o link abaixo:</center>
          <center><p> <a href='.base_url("./Login/trocarSenha/".$url). '> '.$url.'  </a></p></center>
          <p>É muito importante você prosseguir com a recuperação de senha, pois o código de acesso irá expirar em 24 horas da data de abertura de solicitação.</p>
          <b><p>Atenciosamente, R.S.C.<p></b>
        </td>  
      </tr>
      </table>';
	//$mail->Body    = 'This is the HTML message body <b>in bold!</b> <b>'.$nome.'</b><br> <a href='.base_url("./Login/trocarSenha/".$url). '> '.$url.'  </a>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}

}

}
?>
