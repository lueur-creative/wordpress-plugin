<?php

/** N'autoriser qu'une seule catégorie par produit */

function checktoradio()
{
  if (!get_post_type() !== "product") {
    return;
  }

  $screen = get_current_screen();

  if (($screen->parent_base === "edit" && $screen->action === "add") || ($screen->parent_base === "edit" && $_GET["action"] === "edit")) {
    echo '<script type="text/javascript">jQuery("#product_catchecklist-pop input, #product_catchecklist input, .product_cat-checklist input").each(function(){this.type="radio"});</script>';
  }
}

add_action('admin_footer', 'checktoradio');
