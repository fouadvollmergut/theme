<?php 

// Add Analytics Settings Option Page
if ( is_admin() ) {
  add_action( 'admin_menu', 'fvw_ct_add_analytics_options_page' );
  add_action( 'admin_init', 'fvw_ct_register_analytics_settings' );
}

function fvw_ct_add_analytics_options_page () {
  add_submenu_page(
    'options-general.php',
    'Analytics', 
    'Analytics',
    'administrator', 
    __FILE__, 
    'analytics_settings_options_page', 
  );
}

function fvw_ct_register_analytics_settings() {
  register_setting( 'analytics_options', 'fvt_ct_analytics_type' );
  register_setting( 'analytics_options', 'fvt_ct_analytics_key' );
}

function analytics_settings_options_page () {
?>
  <div class="wrap">
  <h1>Einstellungen › Analytics</h1>

  <style>
    .fvt-ct-analytics-settings input[type="text"] {
      width: 100%;
    }
  </style>

  <form method="post" action="options.php" class="fvt-ct-analytics-settings">
      <?php settings_fields( 'analytics_options' ); ?>
      <?php do_settings_sections( 'analytics_options' ); ?>

      <table class="form-table">
          <tr valign="top">
            <th scope="row">Analytics Service</th>
            <td>
              <select name="fvt_ct_analytics_type" id="select_fvt_ct_analytics_type">
                <option
                  value="none"
                  <?php if (!get_option('fvt_ct_analytics_type')) echo 'selected'; ?>
                >
                  Deaktiviert
                </option>
                <option
                  value="<?php echo CST()->GET('ANALYTICS/GOOGLE'); ?>"
                  <?php if (get_option('fvt_ct_analytics_type') === CST()->GET('ANALYTICS/GOOGLE')) echo 'selected'; ?>
                >
                  Google Analytics
                </option>
              </select>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">Analytics Key</th>
            <td>
              <input type="text" name="fvt_ct_analytics_key" value="<?php echo esc_attr( get_option('fvt_ct_analytics_key') ); ?>" />
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