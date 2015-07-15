<?php
/* Inclui a classe do phpmailer */
require("phpmailer/class.phpmailer.php");

/* Cria uma Instância da classe */
$mail = new PHPMailer();


/* #########################
 * # CONFIGURAÇÕES BÁSICAS #
 * #########################
 */

$nome = $_POST["nNome"];
$email = $_POST["nEmail"];
$telefone = $_POST["nTelefone"];
$secretaria = $_POST["nSecretaria"];
$matricula = $_POST["nMatricula"];
$senha = $_POST["nSenha"];

$mensagem = "<h3>DADOS CADASTRADOS</h3><br/>
			 <p><strong>Nome Completo: </strong>".$nome."</p><br/>
			 <p><strong>Email: </strong>".$email."</p><br/>
			 <p><strong>Telefone: </strong>".$telefone."</p><br/>
			 <p><strong>Secretaria: </strong>".$secretaria."</p><br/>
			 <p><strong>Matricula: </strong>".$matricula."</p><br/>
			 <p><strong>Senha: </strong>".$senha."</p>";

$seu_email = 'email@gmail.com';
$seu_nome = 'Nome Test';
$sua_senha = '12345';

/* Se for do Gmail o servidor é: smtp.gmail.com */
$host_do_email = 'smtp.gmail.com';

/* Configura os destinatários (pra quem vai o email) */
$mail->AddAddress($email, $nome);
// $mail->AddAddress('email@email.com');
// $mail->AddCC('email@email.com', 'Nome da pessoa'); // Copia
// $mail->AddBCC('email@email.com', 'Nome da pessoa'); // Cópia Oculta

/* ###########################
 * # CONFIGURAÇÕES AVANÇADAS #
 * ###########################
 */

/* Define que é uma conexão SMTP */
$mail->IsSMTP();
/* Define o endereço do servidor de envio */
$mail->Host = $host_do_email;
/* Utilizar autenticação SMTP */
$mail->SMTPAuth = true;
/* Protocolo da conexão */
$mail->SMTPSecure = "ssl";
/* Porta da conexão */
$mail->Port = "465";
/* Email ou usuário para autenticação */
$mail->Username = $seu_email;
/* Senha do usuário */
$mail->Password = $sua_senha;

/* Configura os dados do remetente do email */
$mail->From = $seu_email; // Seu e-mail
$mail->FromName = $seu_nome; // Seu nome

/* Configura a mensagem */
$mail->IsHTML(true); // Configura um e-mail em HTML

/*
 * Se tiver problemas com acentos, modifique o charset
 * para ISO-8859-1
 */
$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

/* Configura o texto e assunto */
$mail->Subject  = "CADASTRO DE USUÁRIO - ".$nome; // Assunto da mensagem
$mail->Body = $mensagem; // A mensagem em HTML
$mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro

/* Configura o anexo a ser enviado (se tiver um) */
//$mail->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo

/* Envia o email */
$email_enviado = $mail->Send();

/* Limpa tudo */
$mail->ClearAllRecipients();
$mail->ClearAttachments();

/* Mostra se o email foi enviado ou não */
if ($email_enviado) {
	echo "Email enviado!";
	header("Location: http://localhost:8090/CadastroUser/obrigado.html");
} else {
	echo "Não foi possível enviar o e-mail.<br /><br />";
	echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
}
?>
