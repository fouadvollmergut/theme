<?php get_header(); ?>

  <?php if ( post_password_required() ): ?>

    <div class="gdymc_module">
      <?php echo get_the_password_form(); ?>
    </div>

    <?php else: ?>

    <?php if( function_exists( 'areaCreate' ) ) areaCreate(); ?>

  <?php endif; ?>

<?php get_footer(); ?>