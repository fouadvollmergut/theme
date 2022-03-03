<?php 

// Load Base SMTP Settings
require_once 'base_smtp_settings.php';

// Register Custom SMTP Settings
require_once 'custom_smtp_settings.php';

// Send Custom Email
function send_custom_email ($smtp_settings, $to, $clientMail, $clientName, $subject, $message) {

  // Load contact form smtp settings
  if ($smtp_settings == 'contactform') {
    add_action('phpmailer_init', contactform_smtp_settings);
  }

  try {

    $headers = array(
      'Content-Type: text/html; charset=UTF-8',
      'From: ' . $clientName . ' <' . $clientMail . '>',
      'Reply-To: ' . $clientName . ' <' . $clientMail . '>'
    );

    wp_mail($to, $subject, $message);

    error_log('Message has been sent');

    return true;

  } catch (Exception $e) {

    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

    return false;
  }

  // Remove contact form smtp settings
  if ($smtp_settings == 'contactform') {
    remove_action('phpmailer_init', contactform_smtp_settings);
  }
}

  