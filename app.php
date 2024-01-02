<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . "/EasyMail/PHPMailer/Exception.php";
require dirname(__DIR__) . "/EasyMail/PHPMailer/PHPMailer.php";
require dirname(__DIR__) . "/EasyMail/PHPMailer/SMTP.php";
require dirname(__DIR__) . "/EasyMail/config.php";
require dirname(__DIR__) . "/EasyMail/src/db/query.php";

$mail = new PHPMailer(true);

try {                   
    $mail->isSMTP();
    $mail->Host = $config["smtp_host"];
    $mail->SMTPAuth = $config["smtp_auth"];
    $mail->Username  = $config["smtp_username"];
    $mail->Password  = $config["smtp_password"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $config["smtp_port"];

    $mail->setFrom($config["smtp_username"], "Easy Mail");

    $users = getUsers();
    // $message = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc efficitur non sem non sodales. Ut tristique, turpis vel mattis blandit, mi ante consequat dolor, non posuere diam enim nec nisl. Pellentesque varius tortor in purus lacinia, dapibus ornare enim sodales.";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $users = getUsers($_POST["selectedCategory"]);
        // echo"wchodze!";
        // echo "<pre>";
        // var_dump($_GET);
        // echo "<pre/>";
        $message = $_POST["message"];
        foreach($users as $user){
            $mail->addAddress($user["email"], $user["name"]);

            ob_start();
            include dirname(__DIR__) . "/EasyMail/src/template/mail.php";
            $mail->Body = ob_get_clean();

        }
        // echo $message;
        $mail->isHTML(true);
        $mail->Subject = "Here is the subject";
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    
    
        // createCategory();
        // $mail->send();

        // echo "Message has been sent";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


