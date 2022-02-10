<?php

  add_action('gdymc_module_options_settings', function ($module) {
    if( $module->type == gdymc_module_name( __FILE__ ) ):
      optionInput( 'layout', array(
        'type' => 'select',
        'label' => __( 'Layout', 'Theme' ),
        'default' => 'bild_text',
        'options' => array(
          'bild_text' => __( 'Bild | Text', 'Theme' ),
          'text_bild' => __( 'Text | Bild', 'Theme' ),
          'text_text' => __( 'Text | Text', 'Theme' ),
          'bild_bild' => __( 'Bild | Bild', 'Theme' ),
          'shift' => __( 'Bild & Text versetzt', 'Theme' ),
        ),
      ), $module->id );
    endif;
  });

?>