<?php

// SMTP SETTINGS Contact form
function contactform_smtp_settings ( $mail ) {
  $website_title = get_bloginfo('name');

  $smtp_mail = get_field('fvt_secret_smtp_mail', 'option');
  $smtp_host = get_field('fvt_secret_smtp_server', 'option');
  $smtp_port = get_field('fvt_secret_smtp_port', 'option');

  $smtp_username = get_field('fvt_secret_smtp_username', 'option');
  $smtp_password = get_field('fvt_secret_smtp_password', 'option');

  $smtp_encryption = get_field('fvt_secret_smtp_encryption', 'option');

  // Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host       = $smtp_host;
  $mail->SMTPAuth   = true;
  $mail->Username   = $smtp_username;
  $mail->Password   = $smtp_password;
  $mail->SMTPSecure = $smtp_encryption;
  $mail->Port       = $smtp_port;

  // Recipients
  $mail->setFrom($smtp_mail, 'New Request from ' . $website_title);
}