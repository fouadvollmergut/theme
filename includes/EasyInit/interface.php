<?php 

  function icon_type() {
    if (function_exists('get_field')) {
      $ei_icon_type = get_field('fvt_icon_type', 'option');
    }

    $ei_icon_type = apply_filters('fvt_icon_type', $ei_icon_type);

    return $ei_icon_type;
  }

  function background_class($background) {
    $ei_header_background = 'dark';
    $ei_footer_background = 'dark';

    if (function_exists('get_field')) {
      $ei_header_background = get_field('fvt_header_background', 'option');
      $ei_footer_background = get_field('fvt_footer_background', 'option');
    }

    if (CST()->GET('MARKUP/HEADER') === $background) {
      return $ei_header_background;
    } elseif (CST()->GET('MARKUP/FOOTER') === $background) {
      return $ei_footer_background;
    }
  }

  function image_size($image) {
    $ei_full_image_size = CST()->GET('IMAGE/SIZE/FULL/DIMENSIONS');
    $ei_small_image_size = CST()->GET('IMAGE/SIZE/SMALL/DIMENSIONS');

    if (function_exists('get_field')) {
      $ei_full_image_size = get_field('fvt_full_image_size', 'option');
      $ei_small_image_size = get_field('fvt_small_image_size', 'option');
    }

    if (CST()->GET('IMAGE/SIZE/FULL/TYPE') === $image) {
      return $ei_full_image_size;
    } elseif (CST()->GET('IMAGE/SIZE/SMALL/TYPE') === $image) {
      return $ei_small_image_size;
    }
  }
