<?php

  function sendContactMail($req) {

    // From Server
    $recipientMail = get_option('fvt_ct_mail_recipient');
    $subject = get_option('fvt_ct_mail_subject')
      ? get_option('fvt_ct_mail_subject') 
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

    $sent = send_custom_email($recipientMail, $clientMail, $clientName, $subject, $clientMessage);

    if ($sent):
      $res = new WP_REST_Response($response);
      error_log('200');
      return $res;
    else:
      $res = new WP_REST_Response($response);
      $res->set_status(500);
      return $res;
    endif;
  }