<?php

/**
 * Ajout d'un texte au dessous de l'image pour informer l'utilisateur que les photos ne sont pas contractuelles
 */

add_action("woocommerce_product_thumbnails", function () {
?>
  <div style="font-style:italic;font-size:small;">
    <div><i>Photos non contractuelles</i></div>
    <div><i>S’agissant de modèles uniques, les couleurs et les rendus peuvent légèrement varier d’une bougie à l’autre</i></div>
  </div>
<?php
}, 10);
