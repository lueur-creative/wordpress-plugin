<?php

/**
 * Ajout d'un texte au dessous de l'image pour informer l'utilisateur que les photos ne sont pas contractuelles
 */

add_action("wp_head", function () {
?>
  <style>
    .woocommerce-product-gallery::after {
      content: "Photos non contractuelles : S’agissant de modèles uniques, les couleurs et les rendus peuvent légèrement varier d’une bougie à l’autre";
      font-style: italic;
      font-size: small;
    }

    .woocommerce-product-gallery {
      line-height: .75em;
    }
  </style>

<?php
}, 10);
