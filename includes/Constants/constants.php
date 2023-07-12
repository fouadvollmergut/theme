<?php 
  if ( !class_exists('CONSTANTS') ):
    class CONSTANTS {
      public $constants = null;

      function GET( $path ) {
        if( $this->constants === null ):
          $locate = locate_template( 'includes/Constants/constants_object.php' );

          if( $locate ):
            require $locate;
            $this->constants = $constants;
          else:
            $this->constants = false;
          endif;
        endif;
    
        if( !$this->constants ) return false;
    
        $exploded = explode( '/', $path );
    
        $temp = $this->constants;
    
        foreach( $exploded as $key ):
          if( !isset( $temp[ $key ] ) ) return null;
    
          $temp = $temp[ $key ];
        endforeach;
    
        return $temp;
      }
    }

    $constants_instance = new CONSTANTS;
  endif;

  if ( !function_exists('CST') ):
    function CST () {
      global $constants_instance;
      return $constants_instance;
    }
  endif;