<?php

// Configure default smtp settings
function base_smtp_settings ( $mail ) {
  $smtp_host = esc_attr( get_option('fvt_ct_smtp_host') );
  $smtp_port = esc_attr( get_option('fvt_ct_smtp_port') );

  $smtp_username = esc_attr( get_option('fvt_ct_smtp_user') );
  $smtp_password = esc_attr( get_option('fvt_ct_smtp_pass') );

  $smtp_encryption = esc_attr( get_option('fvt_ct_smtp_encryption') );

  // Server settings
  $mail->isSMTP();
  $mail->Host       = $smtp_host;
  $mail->SMTPAuth   = true;
  $mail->Username   = $smtp_username;
  $mail->Password   = $smtp_password;
  $mail->SMTPSecure = $smtp_encryption;
  $mail->Port       = $smtp_port;
  $mail->From       = $smtp_username;
  // $mail->SMTPDebug = 2;
}

add_action('phpmailer_init', 'base_smtp_settings');