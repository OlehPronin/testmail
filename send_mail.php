<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Parsedown;

// SMTP настройки
$mail = new PHPMailer(true);

try {
    // Серверные настройки
    $mail->isSMTP();
    $mail->Host = 'smtp.app.brevo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'OlehLoginnnn';
    $mail->Password = 'Pas$w0rd';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Получатель
    $mail->setFrom('olegpronin1998@gmail.com', 'Mailer');
    $mail->addAddress('olegpronin1998@gmail.com', 'Recipient');

    // Контент письма
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';

    // Markdown текст
    $markdownText = "
    # Привет!

    test text test text test text**.
    ";

    // Конвертация Markdown в HTML
    $parsedown = new Parsedown();
    $htmlContent = $parsedown->text($markdownText);

    $mail->Body    = $htmlContent;
    $mail->AltBody = strip_tags($markdownText);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
