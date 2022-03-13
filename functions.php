<?php

  // THEME Add Easy Init Support
  require_once 'includes/EasyInit/interface.php';

  // THEME Load includes
  require_once 'includes/Footer/footer_options.php';
  require_once 'includes/Mailer/mailer_options.php';
  require_once 'includes/Mailer/mailer.php';
  require_once 'includes/API/api.php';

  // THEME Add custom logo support
  add_theme_support( 'custom-logo' );

  // THEME Allow SVG uploads
  add_filter('upload_mimes', function ($mimes){
    $new_mimes['svg'] = 'image/svg+xml';
    $mimes = array_merge($mimes, $new_mimes);

    return $mimes;
  });

  // THEME Register Menus
  register_nav_menu( 'main', 'Hauptmenü' );
  register_nav_menu( 'foot', 'Fußmenü' );
  register_nav_menu( 'legal', 'Rechtliches' );

  // THEME Add CSS and JS root files  
  add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style( 'themestyle', get_template_directory_uri() . '/scripts/main.css' );
    wp_enqueue_script( 'themescript', get_template_directory_uri() . '/scripts/main.js' );
  });

  // GDYMC Define modules folder location
  add_filter( 'gdymc_modules_folder', function ( $content ) {
    return get_template_directory() . '/modules';
  });

  // GDYMC Add gloabl appearance  settings
  add_action('gdymc_module_options_settings', function ( $module ) {
    optionInput( 'background', array(
      'type' => 'select',
      'options' => array(
        'dark' => __( 'Dunkel', 'Theme' ),
        'bright' => __( 'Hell', 'Theme' ),
      ),
      'default' => 'bright',
      'label' => __( 'Modul-Hintergrund', 'Theme' ),
    ), $module->id );
  });

  add_filter( 'gdymc_module_class', function( $classes ) {
    $appearance = optionGet( 'background' );
    $classes[] = 'background_' . $appearance;
    return $classes;
  });

  add_action( 'add_meta_boxes', function () {
    echo '@@@@';
    add_meta_box(
        'fvw-ct-smtp-recipient-mail',
        'Receipient Mail',
        'fvw_ct_smtp_recipient_mail_html',
        'option',
        'normal',
        'high',
        null
    );
  });

  function fvw_ct_smtp_recipient_mail_html() {
    ?>
    <label for="fvw-ct-smtp-recipient-mail-field">Description for this field</label>
    <input name="fvw-ct-smtp-recipient-mail-field" id="fvw-ct-smtp-recipient-mail-field"></input>
    <?php
  }