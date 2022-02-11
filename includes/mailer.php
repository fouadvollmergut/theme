<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

function get_contact_mail_from_website ($moduleMail, $clientMail, $clientName, $subject, $message) {
  $website_title = get_bloginfo('name');

  $smtp_mail = get_field('fvt_secret_smtp_mail', 'option');
  $smtp_host = get_field('fvt_secret_smtp_server', 'option');
  $smtp_port = get_field('fvt_secret_smtp_port', 'option');

  $smtp_username = get_field('fvt_secret_smtp_username', 'option');
  $smtp_password = get_field('fvt_secret_smtp_password', 'option');

  $smtp_encryption = get_field('fvt_secret_smtp_encryption', 'option');

  $mail = new PHPMailer(true);

  try {

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Server settings
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = $smtp_encryption;
    $mail->Port       = $smtp_port;

    // Recipients
    $mail->setFrom($clientMail, $clientName);
    $mail->addAddress($moduleMail, __('New Request from', 'Theme') . ' ' . $website_title);
    $mail->addReplyTo($clientMail, $clientName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();

    error_log('Message has been sent');

    return true;

  } catch (Exception $e) {

    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

    return false;
  }
}

  