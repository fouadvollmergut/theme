<?php $key = esc_attr( get_option('fvt_ct_analytics_key') ); ?>

<script 
  async
  src="https://www.googletagmanager.com/gtag/js?id=<?php echo $key; ?>"
  type="text/plain"
  data-category="statistics"
></script>

<script>
  window.dataLayer = window.dataLayer || [];

  function gtag () {
    window.dataLayer.push(arguments);
  }

  gtag('js', new Date());
  gtag('config', '<?php echo $key; ?>');
</script>