<?php 

// Load Base SMTP Settings
require_once 'base_smtp_settings.php';


// Send Custom Email
function send_custom_email ($to, $fromMail, $fromName, $subject, $message) {

  // Adjust Headers
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . $fromName . ' <' . $fromMail . '>',
    'Reply-To: ' . $fromName . ' <' . $fromMail . '>'
  );

  $sent = wp_mail($to, $subject, $message, $headers);

  if ($sent):
    error_log('Message has been sent');
    return true;
  else:
    error_log("Message could not be sent.");
    return false;
  endif;
}

  