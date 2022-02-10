<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>
    <?php include 'interface.php'; ?>
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    
    <!-- Site -->
    <div id="site">

      <!-- Header -->
      <header class="background_<?php echo get_field('fvt_header_background', 'option'); ?>">
        <div class="flex row sb center align-center floater">
          <?php if ( has_custom_logo() ): ?>
            <?php the_custom_logo(); ?>
          <?php else: ?>
            <a class="logo" href="<?php echo home_url(); ?>" title="Zur Startseite">
              <?php echo get_bloginfo('name'); ?>
            </a>
          <?php endif; ?>
          
          <div class="navigation__desktop">
            <?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => false ) ); ?>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main id="content">
