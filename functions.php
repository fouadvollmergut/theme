<?php

  // THEME Add Easy Init Support
  require_once 'includes/EasyInit/interface.php';

  // THEME Load includes
  require_once 'includes/Constants/constants.php';
  require_once 'includes/Footer/footer_options.php';
  require_once 'includes/Analytics/analytics.php';
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

  // THEME Add Font Awesome
  add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script( 'icons', 'https://kit.fontawesome.com/3b35bdd7e6.js' );
  });

  // THEME Set Font Awesome Icon Type
  add_filter('fvt_icon_type', function($type) {
    return $type ? $type : 'solid';
  });

  // THEME Add Font Awesome Shortcode
  add_shortcode('i', function($atts) {
    extract( shortcode_atts( array(
      'type' => icon_type(),
      'icon' => '',
      'size' => '',
    ), $atts ));

    if ($size) {
      $size = 'height: ' . $size . '; vertical-align: middle;';
    } else {
      $size = '';
    }

    return '<i style="' . $size . '" class="icon fa-' . $type . ' fa-' . $icon . '"></i>';
  });

  // GDYMC Define modules folder location
  add_filter( 'gdymc_modules_folder', function ( $content ) {
    return get_template_directory() . '/modules';
  });

  // GDYMC Add Shortcode Support

  add_filter( 'gdymc_contentfilter', function ( $content ) {

    if(!gdymc_logged()):
      return do_shortcode( $content );
    else:
      return $content;
    endif;

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