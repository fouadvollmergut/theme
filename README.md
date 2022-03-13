# Pattern

A theme for Wordpress by Foaud Vollmer

## Plugins

- GDY Modular Content
- Classic Editor
- Complianz GDPR

## Usage

1. Download latest release.
2. Place the unpacked theme folder in the themes folder.
3. Install & activate the required plugins.
4. Activate the theme.
5. Add your smtp settings in *Settings* > *Mailer*.
6. Add your footer information in *Settings* > *Footer*.
7. Create a new page and use it as your homepage.
8. Visit your frontend and start placing modules.

## Features

### Mailer Settings

Options page for custom smtp settings. To be able to use the contact form module you should make use of it.  

Find it in the admin menu below the *Settings* pag (Settings > Mailer).

**API**
In php you can access the individual values via wordpress' [`get_option()`](https://developer.wordpress.org/reference/functions/get_option/) function.

``` php
  get_option('fvt_ct_mail_recipient'); // Where should the contact form mails be sent to?
  get_option('fvt_ct_mail_subject'); // Mail Subject
  get_option('fvt_ct_smtp_host'); // SMTP Server
  get_option('fvt_ct_smtp_encryption'); // The encryption your SMTP server is using (in most cases SSL or TLS)
  get_option('fvt_ct_smtp_port'); // SMTP Port (in most cases 587 for SSL encryption – sometimes 465 with TLS)
  get_option('fvt_ct_smtp_user'); // SMTP User (in most cases the mail address you'll be sinding from e.g. norely@yourdomain.com)
  get_option('fvt_ct_smtp_pass'); // Password
```

### Footer Settings

Options page for contents shown in the footer of your page.

**Maps Link**
Use an iFrame embed from a maps provider to show it in the footer (tested with [Google Maps](https://www.google.com/maps)).

**Footer Content**
Text that will be displayed in the left column of your websites footer. Best used for contact details.

## Conventions

Use these rules to participate in development.

### SCSS Classes

**BEM – Block Elment Modifier** 
Use BEM for Class naming in SCSS. This supports nesting within SCSS classes and leads to a natural scoping of those classes.

1. Use the module or component as *block* (inhalt, navigation). **Important:** There should be an individual stylesheet for the block.
2. Give a meaningful name to your *element* (cta, mobile-trigger)
3. Create a *modifiers* if necessary (hidden, disabled)

Your class will then look like this: ´.navigation__mobile-trigger--hidden´
