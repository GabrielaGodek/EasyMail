<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/vendor/phpmailer/phpmailer/src/Exception.php';
require dirname(__DIR__) . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require dirname(__DIR__) . '/vendor/phpmailer/phpmailer/src/SMTP.php';
require dirname(__DIR__) . '/vendor/autoload.php';

require "./config.php";
require dirname(__DIR__) . "/src/db/db_conn.php";


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

        // Sanitize inputs values
        $category = filter_input(INPUT_POST, 'selectedCategory', FILTER_SANITIZE_NUMBER_INT);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $alt = filter_input(INPUT_POST, 'alt', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $conn = openConnection();
        $users = getUsersByCategory($conn, $category);
        closeConnection($conn);

        if (!empty($message) && !empty($subject) && !empty($alt)) {
            foreach ($users as $user) {
                $mail->addAddress($user["email"], $user["name"]);

                ob_start();
                include dirname(__DIR__) . "/src/template/mail.html";
                $mail->Body = ob_get_clean();

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->AltBody = $alt;
                $mail->send();

                header("Location: ../index?success=true");
            }
        }
    }
} catch (Exception $e) {
    include dirname(__DIR__) . "/src/partials/error.php";
}
