<?php
require_once('../../src/PHPMailer.php');
require_once('../../src/SMTP.php');
require_once('../../src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuração do servidor SMTP
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Alterar para DEBUG_SERVER para depurar
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vitorhugobelorio@gmail.com'; // Substituir por variável de ambiente
    $mail->Password = 'vitorh0812';                 // Substituir por variável de ambiente
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configuração de remetente e destinatário
    $mail->setFrom('vitorhugobelorio@gmail.com', 'Vitor Hugo'); // Nome opcional
    $mail->addAddress('vitorhugobsimao@gmail.com');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Teste de envio de e-mail';
    $mail->Body = 'Chegou o e-mail teste do <strong>Vitor Hugo</strong>';
    $mail->AltBody = 'Chegou o e-mail teste do Vitor Hugo';

    // Enviar e-mail
    if ($mail->send()) {
        echo "E-mail enviado com sucesso!";
    } else {
        echo "Falha ao enviar o e-mail.";
    }
} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>
