<?php

/** Traduction des horaires d'ouverture dans le mail de Click&Collect */

function woo_customer_completed_order_template($template)
{
  if ('pickup-instruction.php' === basename($template)) {
    return LUEURCREATIVE_BASE_PATH . "templates/emails/pickup-instruction.php";
  }
  return $template;
}
add_filter('woocommerce_locate_template', 'woo_customer_completed_order_template', 10, 1);
