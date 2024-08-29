<?php

/**
 * Add color styling from settings
 * Inserted with an enqueued CSS file
 */

add_action('wp_head', function () {
?>
  <style>
    .woocommerce-product-gallery__image.flex-active-slide>a>img,
    .attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
      aspect-ratio: 1/1;
      object-fit: cover;
    }
  </style>
<?php
}, 100);
