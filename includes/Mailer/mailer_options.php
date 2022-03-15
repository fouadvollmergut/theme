<?php 

// Add SMTP Settings Option Page
if ( is_admin() ) {
  add_action( 'admin_menu', 'fvw_ct_add_smtp_options_page' );
  add_action( 'admin_init', 'fvw_ct_register_smtp_settings' );
}

function fvw_ct_add_smtp_options_page () {
  add_submenu_page(
    'options-general.php',
    'Mailer', 
    'Mailer',
    'administrator', 
    __FILE__, 
    'smtp_settings_options_page', 
  );
}

function fvw_ct_register_smtp_settings() {
  register_setting( 'smtp_options', 'fvt_ct_mail_recipient' );
  register_setting( 'smtp_options', 'fvt_ct_mail_subject' );
  register_setting( 'smtp_options', 'fvt_ct_smtp_host' );
  register_setting( 'smtp_options', 'fvt_ct_smtp_port' );
  register_setting( 'smtp_options', 'fvt_ct_smtp_user' );
  register_setting( 'smtp_options', 'fvt_ct_smtp_pass' );
  register_setting( 'smtp_options', 'fvt_ct_smtp_encryption' );
}

function smtp_settings_options_page () {
?>
  <div class="wrap">
  <h1>Einstellungen › Mailer</h1>

  <style>
    .fvt-ct-smtp-settings label {
      display: block;
      margin-bottom: 10px;
    }

    .fvt-ct-smtp-settings input[type="text"],
    .fvt-ct-smtp-settings input[type="email"],
    .fvt-ct-smtp-settings input[type="password"],
    .fvt-ct-smtp-settings select {
      width: 100%;
      max-width: 100%;
    }
  </style>

  <form class="fvt-ct-smtp-settings" method="post" action="options.php">
      <?php settings_fields( 'smtp_options' ); ?>
      <?php do_settings_sections( 'smtp_options' ); ?>
      <table class="form-table">
          <tr valign="top">
            <td>
              <h2>Mail Settings</h2>
            </td>
          </tr>

          <tr valign="top">
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_mail_recipient">Mail Recipient</label>
              <input type="email" name="fvt_ct_mail_recipient" value="<?php echo esc_attr( get_option('fvt_ct_mail_recipient') ); ?>" />
            </td>
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_mail_subject">Mail Subject</label>
              <input type="text" name="fvt_ct_mail_subject" value="<?php echo esc_attr( get_option('fvt_ct_mail_subject') ); ?>" />
            </td>
          </tr>

          <tr valign="top">
            <td>
              <h2>SMTP Settings</h2>
            </td>
          </tr>

          <tr valign="top">
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_smtp_host">SMTP Host</label>
              <input type="text" name="fvt_ct_smtp_host" value="<?php echo esc_attr( get_option('fvt_ct_smtp_host') ); ?>" required />
            </td>
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_smtp_encryption">SMTP Encryption</label>
              <select name="fvt_ct_smtp_encryption" id="fvt_ct_smtp_encryption">
                <option value="ssl" <?php echo (get_option('fvt_ct_smtp_encryption') == 'ssl') ? 'selected' : ''; ?>>SSL</option>
                <option value="tls" <?php echo (get_option('fvt_ct_smtp_encryption') == 'tls') ? 'selected' : ''; ?>>TLS</option>
              </select>
            </td>
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_smtp_port">SMTP Port</label>
              <input type="number" name="fvt_ct_smtp_port" value="<?php echo esc_attr( get_option('fvt_ct_smtp_port') ); ?>" required />
            </td>
          </tr>

          <tr valign="top">
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_smtp_user">SMTP User</label>
              <input type="text" name="fvt_ct_smtp_user" value="<?php echo esc_attr( get_option('fvt_ct_smtp_user') ); ?>" required />
            </td>
            <td>
              <label class="fvt-ct-smtp-label" for="fvt_ct_smtp_pass">SMTP Password</label>
              <input type="password" name="fvt_ct_smtp_pass" value="<?php echo esc_attr( get_option('fvt_ct_smtp_pass') ); ?>" required />
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