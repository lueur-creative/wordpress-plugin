<?php

add_action('wp_head', function () {
  if (is_checkout()) {
?>
    <style>
      button#lpc_pick_up_web_service_show_map,
      button#lpc_layer_button_search {
        padding: .75rem;
      }

      button.lpc_relay_choose {
        padding: .5rem;
      }

      .woocommerce-page.woocommerce-checkout form.checkout div#customer_details.col2-set,
      .woocommerce-page.woocommerce-checkout form.checkout div#order_review.woocommerce-checkout-review-order,
      .woocommerce-page.woocommerce-checkout form.checkout h3#order_review_heading {
        width: 100%;
      }
    </style>
<?php
  }
}, 100);
