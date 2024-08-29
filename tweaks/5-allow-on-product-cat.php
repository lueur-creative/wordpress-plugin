<?php

/** N'autoriser qu'une seule catégorie par produit */

function checktoradio()
{
  echo '<script type="text/javascript">jQuery("#product_catchecklist-pop input, #product_catchecklist input, .product_cat-checklist input").each(function(){this.type="radio"});</script>';
}

add_action('admin_footer', 'checktoradio');
