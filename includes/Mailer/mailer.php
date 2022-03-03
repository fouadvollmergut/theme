<?php 

// Load Base SMTP Settings
require_once 'base_smtp_settings.php';


// Send Custom Email
function send_custom_email ($to, $clientMail, $clientName, $subject, $message) {

  // Adjust Headers
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . $clientName . ' <' . $clientMail . '>',
    'Reply-To: ' . $clientName . ' <' . $clientMail . '>'
  );

  try {

    wp_mail($to, $subject, $message, $headers);

    error_log('Message has been sent');
    return true;

  } catch (Exception $e) {

    error_log("Message could not be sent. Mailer Error: {$e}");
    return false;

  }
}

  