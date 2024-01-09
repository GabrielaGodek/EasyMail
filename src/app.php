<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . "/PHPMailer/Exception.php";
require dirname(__DIR__) . "/PHPMailer/PHPMailer.php";
require dirname(__DIR__) . "/PHPMailer/SMTP.php";
require dirname(__DIR__) . "/config.php";
require dirname(__DIR__) . "/src/db/query.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $config["smtp_host"];
    $mail->SMTPAuth = $config["smtp_auth"];
    $mail->Username = $config["smtp_username"];
    $mail->Password = $config["smtp_password"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $config["smtp_port"];
    $mail->setFrom($config["smtp_username"], "Easy Mail");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $users = getUsersByCategory($_POST["selectedCategory"]);
        $message = $_POST["message"];
        $subject = $_POST["subject"];
        $alt = $_POST["alt"];

        if (!empty($message) && !empty($subject) && !empty($alt)) {
            foreach ($users as $user) {
                $mail->addAddress($user["email"], $user["name"]);

                ob_start();
                include dirname(__DIR__) . "/src/template/mail.php";
                $mail->Body = ob_get_clean();

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->AltBody = $alt;
                $mail->send();

                header("Location: ../index.php?success=true");
            }  
        }
    }
} catch (Exception $e) {
    include dirname(__DIR__) . "/src/partials/error.php";
}
