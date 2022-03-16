<?php 

  function background_class($background) {
    $ei_header_background = 'dark';
    $ei_footer_background = 'dark';

    if (function_exists('get_field')) {
      $ei_header_background = get_field('fvt_header_background', 'option');
      $ei_footer_background = get_field('fvt_footer_background', 'option');
    }

    if ($background === 'header') {
      return $ei_header_background;
    } elseif ($background === 'footer') {
      return $ei_footer_background;
    }
  }

  function image_size($image) {
    $ei_full_image_size = '2560x1280';
    $ei_small_image_size = '1280x1280';

    if (function_exists('get_field')) {
      $ei_full_image_size = get_field('fvt_full_image_size', 'option');
      $ei_small_image_size = get_field('fvt_small_image_size', 'option');
    }

    if ($image === 'full') {
      return $ei_full_image_size;
    } elseif ($image === 'small') {
      return $ei_small_image_size;
    }
  }
