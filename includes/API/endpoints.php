<?php
  add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/send', array(
        'methods' => 'POST',
        'callback' => 'sendContactMail'
    ));
  });