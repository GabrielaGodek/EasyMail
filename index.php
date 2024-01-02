<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/EasyMail/PHPMailer/Exception.php';
require dirname(__DIR__) . '/EasyMail/PHPMailer/PHPMailer.php';
require dirname(__DIR__) . '/EasyMail/PHPMailer/SMTP.php';
require dirname(__DIR__) . '/EasyMail/config.php';

$mail = new PHPMailer(true);

try {                   
    $mail->isSMTP();
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = $config['smtp_auth'];
    $mail->Username  = $config['smtp_username'];
    $mail->Password  = $config['smtp_password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $config['smtp_port'];

    $mail->setFrom($config['smtp_username'], 'Easy Mail');
    $mail->addAddress('godekgabriela39@gmail.com', 'Gabriela Godek');

    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body  = 'Lighten version <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
