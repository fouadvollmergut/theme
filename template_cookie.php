<?php get_header(); /* Template Name: Cookie-Richtlinie */ ?>

  <style>
    #cmplz-document {
      max-width: inherit !important;
    }

    #cmplz-document a {
      color: #a5a5a5 !important;
      text-decoration: none !important;
    }

    #cmplz-document a:hover {
      text-decoration: underline !important;
    }


    #cmplz-document, #cmplz-document p, #cmplz-document li, 
    #cmplz-document td, #cmplz-document h3 {
      font-size: inherit;
    }

    #cmplz-document h2 {
      font-size: 2em;
      text-transform: uppercase;
      position: relative;
      padding: 20px 0px;
      border-bottom: none !important;
    }

    #cmplz-cookies-overview .cmplz-service-desc h4 {
      font-size: 18px !important;
    }


    #cmplz-document ul {
      margin-left: 22px !important;
    }

    #cmplz-cookies-overview .cmplz-dropdown summary div:after, #cmplz-document .cmplz-dropdown summary div:after {
      background: none !important;
    }

    #cmplz-cookies-overview .cmplz-dropdown .cookies-per-purpose, 
    #cmplz-document .cmplz-dropdown .cookies-per-purpose {
      border: none !important;
      margin-bottom: 0px !important;
    }

    #cmplz-cookies-overview .cmplz-dropdown summary, 
    #cmplz-document .cmplz-dropdown summary {
      margin: 0px !important;
      padding: 10px !important;
    }

    #cmplz-cookies-overview details {
      margin: 0px;
    }

    details+details {
         margin: 0px !important;
        margin-top: -2px !important;
    }
  </style>

  <div class="gdymc_module">
    <div class="modulePadding">

      <?php echo do_shortcode( '[cmplz-document type="cookie-statement" region="eu"]' );?>

    </div>
  </div>

<?php get_footer(); ?>