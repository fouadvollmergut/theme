      </main>

      <?php
        $menu = has_nav_menu( 'foot' );
        $info = trim(get_option('fvt_ct_footer_content'));
        $map = get_option('fvt_ct_footer_map_frame');
        $analytics = get_option('fvt_ct_analytics_type');
      ?>

      <!-- Footer -->
      <?php if ($menu || $info || $map): ?>
      <footer>
        <div class="background_<?php echo background_class('footer'); ?>">
          <div class="footer__inner flex column gap-double">
            <div class="flex column sb gap">
                <?php if ($map): ?>
                  <div class="footer__map floater"><?php echo $map; ?></div>
                <?php endif; ?>

                <?php if ($info || $menu): ?>
                  <div class="flex row sb gap modulePadding floater">
                  <?php if ($info): ?>
                    <div class="footer__content"><?php echo $info; ?></div>
                  <?php endif; ?>

                  <?php if ($menu): ?>
                    <div class="navigation__footer">
                      <?php wp_nav_menu( array( 'theme_location' => 'foot', 'container' => false ) ); ?>
                    </div>
                  <?php endif; ?>
                  </div>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </footer>
      <?php endif; ?>

      <div class="superfooter">
        <div class="flex row sb gap floater">
          <div class="navigation__legal">
            <?php wp_nav_menu( array( 'theme_location' => 'legal', 'container' => false ) ); ?>
          </div>
          <a class="fv" href="<?php echo add_query_arg( 'source', $_SERVER[ 'HTTP_HOST' ], 'https://fouadvollmer.de/' ); ?>" target="_blank">
            <span><?php _e( 'Webseite von', 'Theme' ); ?></span> <span>Fouad Vollmer</span>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Overlays -->
    <?php include get_template_directory() . '/overlays.php'; ?>

    <!-- Analytics -->
    <?php if (CST()->GET('ANALYTICS/GOOGLE') === $analytics) require_once 'includes/Analytics/analytics_google.php'; ?>

    <?php wp_footer(); ?>

  </body>
</html>