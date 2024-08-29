<?php

/** Ajout des informations de sécurité à la page d'un produit */

add_action("woocommerce_after_single_product_summary", function () {
  global $product;
  $category_list = get_the_term_list($product->get_id(), "product_cat");

  if (strpos($category_list, "Bougies")) { ?>
    <div>
      <h2>Sécurité et conseils d'utilisation</h2>
      <p>Bougie à tenir éloignée <b>des enfants et des animaux</b>. Bougie <b>non comestible.</b></p>

      <p>Pour une meilleure combustion, il est conseillé de toujours couper la mèche à 1 cm avant de l'allumer.</p>

      <p>Bien laisser fondre votre bougie minimum 3h à la première fonte pour que toute la surface puisse fondre. Cela évitera qu'elle se creuse.</p>

      <p><i>S’agissant de modèles uniques, les photos sont non contractuelles. Les couleurs et les rendus peuvent légèrement varier d’une bougie à l’autre.</i></p>
    </div>
  <?php
  } elseif (strpos($category_list, "Brûle-parfums")) {
  ?>
    <div>
      <h2>Utilisation</h2>
      <p>Disposer votre fondant sur le dessus du brûle parfum, insérer une bougie chauffe plat allumée et profiter du parfum.</p>
    </div>
    <div>
      <h2>Sécurité et conseils d'utilisation</h2>
      <p>À tenir éloigné <b>des enfants et des animaux</b>.</p>

      <p>Utiliser dans une pièce ventilée et aérée quotidiennement.</p>

      <p>Placez le brûle-parfum sur une surface stable et plane protégée</p>

      <p>Ne jamais laisser se consumer sans surveillance.</p>

      <p>Nos brûle-parfums doivent être utilisés avec des bougies chauffe-plat de diamètre 4 cm et d’un temps de combustion de 4 heures maximum. La bougie doit répondre aux normes en vigueurs. Veillez également à respecter les consignes de sécurités indiquées sur la bougie.</p>
    </div>
  <?php
  } elseif (strpos($category_list, "Fondants")) {
  ?>
    <div>
      <h2>Sécurité et conseils d'utilisation</h2>
      <p>À tenir éloigné <b>des enfants et des animaux</b>. Fondant ou tablette <b>non comestible</b>.</p>

      <p>Utiliser dans une pièce ventilée et aérée quotidiennement.</p>

      <p>Ne jamais laisser se consumer sans surveillance.</p>
    </div>
<?php
  }
}, 15);
