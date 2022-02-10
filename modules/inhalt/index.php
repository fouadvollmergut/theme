<?php 
  $module_layout = optionGet('layout', $module->id);
  
  $small_image_size = get_field('fvt_small_image_size', 'option');

  $layout_flex = $module_layout === 'text_bild' ? 'row-reverse' : 'row';
?>

<div class="module modulePadding">
  <div class="flex <?php echo $layout_flex; ?> sb gap-double same-size">
    <?php if ($module_layout === 'text_text'): ?>

      <div class="flex column gap start">
        <?php if( contentCheck( 'headline_1' ) ): ?>
          <h2><?php contentCreate( 'headline_1', 'text' ); ?></h2>
        <?php endif; ?>

        <?php if( contentCheck( 'text_1' ) ): ?>
          <?php contentCreate( 'text_1', 'text' ); ?>
        <?php endif; ?>
      </div>

      <div class="flex column gap start">
        <?php if( contentCheck( 'headline_2' ) ): ?>
          <h2><?php contentCreate( 'headline_2', 'text' ); ?></h2>
        <?php endif; ?>

        <?php if( contentCheck( 'text_2' ) ): ?>
          <?php contentCreate( 'text_2', 'text' ); ?>
        <?php endif; ?>
      </div>

    <?php elseif ($module_layout === 'bild_bild'): ?>

      <div class="small_image">
        <?php contentCreate( 'image_1', 'image', $small_image_size ); ?>
      </div>
      
      <div class="small_image">
        <?php contentCreate( 'image_2', 'image', $small_image_size ); ?>
      </div>

      <?php elseif ($module_layout === 'shift'): ?>

        <div class="flex column gap-double start shift">
          <div class="small_image">
            <?php contentCreate( 'image_1', 'image', $small_image_size ); ?>
          </div>

          <div class="flex column gap start">
            <?php if( contentCheck( 'headline_1' ) ): ?>
              <h2><?php contentCreate( 'headline_1', 'text' ); ?></h2>
            <?php endif; ?>

            <?php if( contentCheck( 'text_1' ) ): ?>
              <?php contentCreate( 'text_1', 'text' ); ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="flex column gap-double start shift">
          <div class="small_image">
            <?php contentCreate( 'image_2', 'image', $small_image_size ); ?>
          </div>

          <div class="flex column gap start">
            <?php if( contentCheck( 'headline_2' ) ): ?>
              <h2><?php contentCreate( 'headline_2', 'text' ); ?></h2>
            <?php endif; ?>

            <?php if( contentCheck( 'text_2' ) ): ?>
              <?php contentCreate( 'text_2', 'text' ); ?>
            <?php endif; ?>
          </div>
        </div>

    <?php else: ?>

      <div class="small_image">
        <?php contentCreate( 'image_1', 'image', $small_image_size ); ?>
      </div>

      <div class="flex column gap start">
        <?php if( contentCheck( 'headline_1' ) ): ?>
          <h2><?php contentCreate( 'headline_1', 'text' ); ?></h2>
        <?php endif; ?>

        <?php if( contentCheck( 'text_1' ) ): ?>
          <?php contentCreate( 'text_1', 'text' ); ?>
        <?php endif; ?>
      </div>

    <?php endif; ?>
  </div>
</div>
