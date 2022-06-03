<?php 
  $analytics = get_option('fvt_ct_analytics_type');

  function track ($action, $category, $label = '') {
    if (CT()->GET('ANALYTICS/GOOGLE') === $analytics):
?>
      <script>
        if (typeof gtag === 'function') { 
          gtag('event', '<?php echo $action ?>', {
            'event_category': '<?php echo $category ?>',
            'event_label': '<?php echo $label ?>',
          });
        }
      </script>
<?php
    endif;
  }