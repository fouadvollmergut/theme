<?php

  function sendContactMail($req) {

    // From Server
    $recipientMail = get_field('fvt_secret_receipient_mail', 'option');
    $subject = get_field('fvt_secret_mail_subject', 'option') 
      ? get_field('fvt_secret_mail_subject', 'option') 
      : 'Mail from ' . $req['name'] . ' on ' . get_bloginfo('name');

    // From Client
    $clientName = $req['name'];
    $clientMail = $req['mail'];
    $clientMessage = $req['message'];

    $response = [
        'name' => $clientName,
        'mail' => $clientMail,
        'message' => $clientMessage
    ];

    try {

      $sent = send_custom_email($recipientMail, $clientMail, $clientName, $subject, $clientMessage);

      $res = new WP_REST_Response($response);
      $res->set_status(200);

      return $res;

    } catch (Exception $e) {

      error_log("Message could not be sent. Mailer Error: {$e}");

      $res = new WP_REST_Response($response);
      $res->set_status(500);

      return false;
    }
  }