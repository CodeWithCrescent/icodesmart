<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
	$app_name = 'I Code Smart | Website';
    $mail_from = 'crescentbeatz31@gmail.com';
	$mail_to = 'crescent.sambila@gmail.com';
    $app_password = 'secret';
	//$attachmentPath = '../assets/img/apple-touch-icon.png';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // create PHPMailer object
    $mail = new PHPMailer(true);

    // configure SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $mail_from;
    $mail->Password = $app_password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // set email content
    $mail->setFrom($mail_from, $app_name);
	$mail->addReplyTo($email, $name);
    $mail->addAddress($mail_to);
	//$mail->addAttachment($attachmentPath, 'Name of Attachment');
	$mail->isHTML(true); // Set email content as HTML
    $mail->Subject = $subject;
    $mail->Body = $message;

    // attempt to send email
    try {
        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
