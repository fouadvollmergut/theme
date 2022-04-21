<?php

  function sendContactMail($req) {

    // From Client
    $clientName = $req['name'];
    $clientMail = $req['mail'];
    $clientPrivacy = $req['privacy'];

    // From Server
    $recipientMail = get_option('fvt_ct_mail_recipient');
    $subject = get_option('fvt_ct_mail_subject')
      ? get_option('fvt_ct_mail_subject') 
      : 'Mail from ' . $req['name'] . ' on ' . get_bloginfo('name');

    error_log(print_r($_POST, true));

    // Mail Content
    $mailContentRows = '';

    foreach($_POST as $key => $value) {
      if ($key != 'submit' && $key != 'privacy') {
        $mailContentRows .= '<tr>';
        $mailContentRows .= '<td style="padding: 10px 20px; background-color: #c3c3c3; border-top: 5px;">' . htmlspecialchars(ucfirst($key)) . '</td>';
        $mailContentRows .= '<td style="padding: 10px 20px; background-color: #c3c3c3; border-top: 5px;">' . htmlspecialchars($value) . '</td>';
        $mailContentRows .= '</tr>';
      }
    }

    $mailContent = '
      <h1>' . $subject . '</h1>
      <table>'
        . $mailContentRows .
      '</table>
    ';

    // Attachments
    $attachments = [];

    foreach($_FILES as $file) {
      if ($file['error'] === 0) {
        array_push($attachments, $file['tmp_name']);
      } else {
        $res = new WP_REST_Response($response);
        $res->set_status(500);
        return $res;
      }
    }

    $sent = send_custom_email($recipientMail, $clientMail, $clientName, $subject, $mailContent, $attachments);

    $response = [
      'name' => $clientName,
      'mail' => $clientMail,
      'priavcy' => $clientPrivacy
    ];

    if ($sent):
      $res = new WP_REST_Response($response);
      error_log(print_r($response, true));
      error_log('200');
      return $res;
    else:
      $res = new WP_REST_Response($response);
      $res->set_status(500);
      return $res;
    endif;
  }