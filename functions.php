<?php

  // THEME Load includes
  require_once 'includes/Mailer/mailer.php';
  require_once 'includes/API/api.php';

  // THEME Add custom logo support
  add_theme_support( 'custom-logo' );

  // THEME Allow SVG uploads
  add_filter( 'upload_mimes', function () {
    $mimes['svg'] = 'image/svg+xml';
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

  // ACF Add Theme Settings Page
  if( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
      'page_title' => 'Theme',
      'menu_title' => 'Theme',
      'menu_slug' => 'theme-options',
      'capability' => 'switch_themes',
      'redirect' => false,
      'icon_url' => 'dashicons-admin-settings',
      'position' => 59
    ) );
  }