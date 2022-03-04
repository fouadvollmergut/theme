<?php
  $full_image_size = get_field('fvt_full_image_size', 'option');
?>

<div>
  <div class="gallery full_image">
    <?php contentCreate( 1, 'gallery', $full_image_size ); ?>
  </div>
</div><!-- .modulePadding -->