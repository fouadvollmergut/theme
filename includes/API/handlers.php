<?php

  function sendContactMail($req) {
    $to = get_field('fvt_secret_receipient_mail', 'option');
    $subject = get_field('fvt_secret_mail_subject', 'option') 
      ? get_field('fvt_secret_mail_subject', 'option') 
      : 'Mail from ' . $req['name'] . ' on ' . get_bloginfo('name');

    $name = $req['name'];
    $mail = $req['mail'];
    $message = $req['message'];

    $sent = get_contact_mail_from_website($to, $mail, $name, $subject, $message);

    $response = [
        'to' => $to,
        'subject' => $subject,
        'message' => $message,
        'headers' => $headers
    ];

    $res = new WP_REST_Response($response);
    $res->set_status(200);

    return $res;
  }