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