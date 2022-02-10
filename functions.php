<?php

  // Load PHPMailer and custom API
  require_once 'includes/mailer.php';
  require_once 'includes/API/handlers.php';
  require_once 'includes/API/endpoints.php';

  add_theme_support( 'custom-logo' );

  // Save ACF fields
  add_filter('acf/settings/save_json', function ( $path ) {
    $path = get_stylesheet_directory() . '/acf';
    return $path;
  });

  // Load ACF fields
  add_filter('acf/settings/load_json', function ( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf';
    return $paths;
  });

  // Add gloabl appearance  settings
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

  // Add Theme Settings Page
  if( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
      'page_title' => 'Theme',
      'menu_title' => 'Theme',
      'menu_slug' => 'theme-options',
      'capability' => 'edit_posts',
      'redirect' => false,
      'icon_url' => 'dashicons-admin-settings',
      'position' => 59
    ) );
  }

  // Register Menus
  register_nav_menu( 'main', 'Hauptmenü' );
  register_nav_menu( 'foot', 'Fußmenü' );
  register_nav_menu( 'legal', 'Rechtliches' );

  // Add CSS and JS root files  
  add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style( 'themestyle', get_template_directory_uri() . '/scripts/main.css' );
    wp_enqueue_script( 'themescript', get_template_directory_uri() . '/scripts/main.js' );
  });