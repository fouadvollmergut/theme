      </main>

      <?php
        $menu = has_nav_menu( 'foot' );
        $info = get_field('fvt_footer_information', 'option');
        $map = get_field('fvt_footer_google_maps', 'option');
      ?>

      <!-- Footer -->
      <?php if ($menu || $info || $map): ?>
      <footer>
        <div class="background_<?php echo get_field('fvt_footer_background', 'option'); ?>">
          <div class="footer__inner flex column gap-double">
            <div class="flex column sb gap">
                <?php if ($map): ?>
                  <div class="map floater">
                    <?php echo $map; ?>
                  </div>
                <?php endif; ?>

                <?php if ($info || $menu): ?>
                  <div class="flex row sb gap modulePadding floater">
                  <?php if ($info): ?>
                    <div>
                      <?php echo $info; ?>
                    </div>
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

    <?php wp_footer(); ?>

  </body>
</html>