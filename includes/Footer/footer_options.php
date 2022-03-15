<?php 

// Add SMTP Settings Option Page
if ( is_admin() ) {
  add_action( 'admin_menu', 'fvw_ct_add_footer_options_page' );
  add_action( 'admin_init', 'fvw_ct_register_footer_settings' );
}

function fvw_ct_add_footer_options_page () {
  add_submenu_page(
    'options-general.php',
    'Footer', 
    'Footer',
    'administrator', 
    __FILE__, 
    'footer_settings_options_page', 
  );
}

function fvw_ct_register_footer_settings() {
  register_setting( 'footer_options', 'fvt_ct_footer_map_frame' );
  register_setting( 'footer_options', 'fvt_ct_footer_content' );
}

function footer_settings_options_page () {
?>
  <div class="wrap">
  <h1>Einstellungen › Footer</h1>

  <style>
    .fvt-ct-footer-settings textarea {
      resize: vertical;
      width: 100%;
    }

    .fvt-ct-footer-settings input[type="text"] {
      width: 100%;
    }
  </style>

  <form method="post" action="options.php" class="fvt-ct-footer-settings">
      <?php settings_fields( 'footer_options' ); ?>
      <?php do_settings_sections( 'footer_options' ); ?>
      <table class="form-table">
          <tr valign="top">
            <th scope="row">Map iFrame</th>
            <td>
              <input type="text" name="fvt_ct_footer_map_frame" value="<?php echo esc_attr( get_option('fvt_ct_footer_map_frame') ); ?>" />
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">Footer Content</th>
            <td>
              <?php 
                $settings = array( 
                  'media_buttons' => false,
                  'teeny' => true 
                );
              
                wp_editor(get_option('fvt_ct_footer_content'), 'fvt_ct_footer_content', $settings); 
              ?>
            </td>
          </tr>

          <tr valign="top">
            <td>
              <?php submit_button(); ?>
            </td>
          </tr>
      </table>
  </form>
  </div>
<?php
}