<?php 

  function background_class($background) {
    $base_header_background = 'dark';
    $base_footer_background = 'dark';

    if (function_exists('get_field')) {
      $ei_header_background = get_field('fvt_header_background', 'option');
      $ei_footer_background = get_field('fvt_footer_background', 'option');
    }

    if ($background === 'header') {
      return $ei_header_background ? $ei_header_background : $base_header_background;
    } elseif ($background === 'footer') {
      return $ei_footer_background ? $ei_footer_background : $base_footer_background;
    }
  }

  function image_size($image) {
    $base_full_image_size = '3000x1500';
    $base_small_image_size = '1500x1500';

    if (function_exists('get_field')) {
      $ei_full_image_size = get_field('fvt_full_image_size', 'option');
      $ei_small_image_size = get_field('fvt_small_image_size', 'option');
    }

    if ($image === 'full') {
      return $ei_full_image_size ? $ei_full_image_size : $base_full_image_size;
    } elseif ($image === 'small') {
      return $ei_small_image_size ? $ei_small_image_size : $base_small_image_size;
    }
  }
