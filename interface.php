<!-- Backend Variables -->
<?php
  function RGBtoHSL($color) {
    $r = $color['red']; $g = $color['green']; $b = $color['blue'];
    $r /= 255; $g /= 255; $b /= 255;
    $max = max( $r, $g, $b );
    $min = min( $r, $g, $b );
    $h; $s; $l = ( $max + $min ) / 2;
    $d = $max - $min;

      if ($d == 0) { 
        $h = $s = 0; 
      } else {
        $s = $d / ( 1 - abs( 2 * $l - 1 ) );
        switch( $max ) {
          case $r:
            $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
            if ($b > $g) { $h += 360; }
          break;

          case $g:
            $h = 60 * ( ( $b - $r ) / $d + 2 );
          break;

          case $b:
            $h = 60 * ( ( $r - $g ) / $d + 4 );
          break;
        }
      }

    return array( 
      'h' => round($h, 3) . 'deg', 
      's' => round($s * 100, 3) . '%', 
      'l' => round($l * 100, 3) . '%'
    );
  }

  $header_logo_height = get_field('fvt_header_logo_height', 'option');

  // Colors
  $bright_background_color = get_field('fvt_bright_background_color', 'option');
  $dark_background_color = get_field('fvt_dark_background_color', 'option');
  $accent_color = get_field('fvt_accent_color', 'option');
  $bright_font_color = get_field('fvt_bright_font_color', 'option');
  $dark_font_color = get_field('fvt_dark_font_color', 'option');

  // Fonts
  $base_font_url = get_field('fvt_font_url', 'option');
  $base_font_family = get_field('fvt_font_family', 'option');
  $display_font_url = get_field('fvt_display_font_url', 'option');
  $display_font_family = get_field('fvt_display_font_family', 'option');
  $font_settings = get_field('fvt_font_settings', 'option');

  // Sapcing
  $outer_spacing = get_field('fvt_outer_spacing', 'option');
  $inner_spacing = get_field('fvt_inner_spacing', 'option');
  $max_width = get_field('fvt_max_width', 'option');

  // Images
  $full_image_aspect_ratio = get_field('fvt_full_image_aspect_ratio', 'option');
  $small_image_aspect_ratio = get_field('fvt_small_image_aspect_ratio', 'option');
?>

<style>
  /* Imports */
  /* Base Font */
  @import url('<?php echo $base_font_url; ?>');

  <?php if ($display_font_url): ?>
  /* Display Font */
  @import url('<?php echo $display_font_url; ?>');
  <?php endif; ?>
  /* Variables */

  :root {
    --shift: 10%;

    /* Accent Color */
    --accent-h: <?php echo RGBtoHSL($accent_color)['h']; ?>;
    --accent-s: <?php echo RGBtoHSL($accent_color)['s']; ?>;
    --accent-l: <?php echo RGBtoHSL($accent_color)['l']; ?>;
    --fvt-color-accent: hsl(var(--accent-h), var(--accent-s), var(--accent-l));
    --fvt-color-accent-lighter: hsl(var(--accent-h), var(--accent-s), calc(var(--accent-l) + var(--shift)));
    --fvt-color-accent-darker: hsl(var(--accent-h), var(--accent-s), calc(var(--accent-l) - var(--shift)));

    /* Background Bright */
    --background-bright-h: <?php echo RGBtoHSL($bright_background_color)['h']; ?>;
    --background-bright-s: <?php echo RGBtoHSL($bright_background_color)['s']; ?>;
    --background-bright-l: <?php echo RGBtoHSL($bright_background_color)['l']; ?>;
    --fvt-color-bright-background: hsl(var(--background-bright-h), var(--background-bright-s), var(--background-bright-l));
    --fvt-color-bright-background-lighter: hsl(var(--background-bright-h), var(--background-bright-s), calc(var(--background-bright-l) + var(--shift)));
    --fvt-color-bright-background-darker: hsl(var(--background-bright-h), var(--background-bright-s), calc(var(--background-bright-l) - var(--shift)));
    --fvt-color-bright-background-darker-disabled: hsla(var(--background-bright-h), var(--background-bright-s), calc(var(--background-bright-l) - var(--shift)), .5);
    --fvt-color-bright-background-darker-active: hsla(var(--background-bright-h), var(--background-bright-s), calc(var(--background-bright-l) - var(--shift)), 1);

    /* Background Dark */
    --background-dark-h: <?php echo RGBtoHSL($dark_background_color)['h']; ?>;
    --background-dark-s: <?php echo RGBtoHSL($dark_background_color)['s']; ?>;
    --background-dark-l: <?php echo RGBtoHSL($dark_background_color)['l']; ?>;
    --fvt-color-dark-background: hsl(var(--background-dark-h), var(--background-dark-s), var(--background-dark-l));
    --fvt-color-dark-background-lighter: hsl(var(--background-dark-h), var(--background-dark-s), calc(var(--background-dark-l) + var(--shift)));
    --fvt-color-dark-background-darker: hsl(var(--background-dark-h), var(--background-dark-s), calc(var(--background-dark-l) - var(--shift)));
    --fvt-color-dark-background-lighter-disabled: hsla(var(--background-dark-h), var(--background-dark-s), calc(var(--background-dark-l) + var(--shift)), .5);
    --fvt-color-dark-background-lighter-active: hsla(var(--background-dark-h), var(--background-dark-s), calc(var(--background-dark-l) + var(--shift)), 1);

    /* Bright Font */
    --font-bright-h: <?php echo RGBtoHSL($bright_font_color)['h']; ?>;
    --font-bright-s: <?php echo RGBtoHSL($bright_font_color)['s']; ?>;
    --font-bright-l: <?php echo RGBtoHSL($bright_font_color)['l']; ?>;
    --fvt-color-bright-font: hsl(var(--font-bright-h), var(--font-bright-s), var(--font-bright-l));
    --fvt-color-bright-font-lighter: hsl(var(--font-bright-h), var(--font-bright-s), calc(var(--font-bright-l) + var(--shift)));
    --fvt-color-bright-font-darker: hsl(var(--font-bright-h), var(--font-bright-s), calc(var(--font-bright-l) - var(--shift)));

    /* Dark Font */
    --font-dark-h: <?php echo RGBtoHSL($dark_font_color)['h']; ?>;
    --font-dark-s: <?php echo RGBtoHSL($dark_font_color)['s']; ?>;
    --font-dark-l: <?php echo RGBtoHSL($dark_font_color)['l']; ?>;
    --fvt-color-dark-font: hsl(var(--font-dark-h), var(--font-dark-s), var(--font-dark-l));
    --fvt-color-dark-font-lighter: hsl(var(--font-dark-h), var(--font-dark-s), calc(var(--font-dark-l) + var(--shift)));
    --fvt-color-dark-font-darker: hsl(var(--font-dark-h), var(--font-dark-s), calc(var(--font-dark-l) - var(--shift)));

    /* Utility Colors */
    --fvt-color-danger: hsl(357, 76%, 59%);

    /* Base Font */
    --fvt-base-font-family: <?php echo $base_font_family; ?>;

    <?php if ($display_font_family): ?>
    /* Display Font */
    --fvt-display-font-family: <?php echo $display_font_family; ?>;
    <?php endif; ?>

    /* Font Settings */
    <?php for ($i = 1; $i <= 6; $i++): ?>
    <?php $headline = "h" . $i; ?>
    --fvt-<?php echo $headline; ?>-font-family: <?php echo $font_settings[$headline . '_font-family'] === 'display' ? $display_font_family : $base_font_family; ?>;
    --fvt-<?php echo $headline; ?>-font-size: <?php echo $font_settings[$headline . '_font-size'] . 'px'; ?>;
    --fvt-<?php echo $headline; ?>-font-weight: <?php echo $font_settings[$headline . '_font-weight']; ?>;
    --fvt-<?php echo $headline; ?>-line-height: <?php echo $font_settings[$headline . '_line-height']; ?>;
    <?php endfor; ?>

    /* Text */
    --fvt-p-font-family: <?php echo $font_settings['font-family'] === 'display' ? $display_font_family : $base_font_family; ?>;
    --fvt-p-font-size: <?php echo $font_settings['font-size'] . 'px'; ?>;
    --fvt-p-font-weight: <?php echo $font_settings['font-weight']; ?>;
    --fvt-p-line-height: <?php echo $font_settings['line-height']; ?>;

    /* Spacing */
    --fvt-outer-spacing: <?php echo $outer_spacing . 'px'; ?>;
    --fvt-inner-spacing: <?php echo $inner_spacing . 'px'; ?>;
    --fvt-max-width: <?php echo $max_width . 'px'; ?>;

    /* Images */
    --fvt-full-image-aspect-ratio: <?php echo $full_image_aspect_ratio; ?>;
    --fvt-small-image-aspect-ratio: <?php echo $small_image_aspect_ratio; ?>;

    /* Components */
    --fvt-header-logo-height: <?php echo $header_logo_height . 'px'; ?>;
  }
</style>
