<?php

/** Ajoute les étiquettes note de tête/coeur/fond et un onglet supplémentaire sur la fiche produit */

function get_sents_types()
{
  return ["sent_tete" => "Note de tête", "sent_coeur" => "Note de cœur", "sent_fond" => "Note de fond"];
}

/** 1 - Créer les attributs */

require_once __DIR__ . "/../lib/create-attributes.php";

function sents_create_wc_attribute_on_init()
{
  // Vérifiez si WooCommerce est actif avant d'exécuter le code
  if (class_exists('WooCommerce')) {
    foreach (get_sents_types() as $slug => $label) {
      // Assurez-vous que l'attribut est créé si nécessaire
      ensure_attribute_exists($slug, $label, true);
    }
  }
}
add_action('woocommerce_init', 'sents_create_wc_attribute_on_init');

/** Afficher la pyramide olphactive dans un nouvel onglet */

function add_product_sents_tab($tabs)
{
  /** @var WC_Product $product */
  global $product;

  $category_list = get_the_term_list($product->get_id(), "product_cat");

  if (strpos($category_list, "Bougies")) {
    $tabs['sents'] = array(
      'title' => "Pyramide olfactive",
      'priority' => 15, // TAB SORTING (DESC 10, ADD INFO 20, REVIEWS 30)
      'callback' => 'add_product_sents_tab_content', // TAB CONTENT CALLBACK
    );
  }

  return $tabs;
}
add_filter('woocommerce_product_tabs', 'add_product_sents_tab', 50);

function add_product_sents_tab_content()
{
  /** @var WC_Product $product */
  global $product;

  foreach (get_sents_types() as $sents_type_slug => $sents_type_label) {
    $terms = $product->get_attribute("pa_$sents_type_slug");

    if (strlen($terms) > 0) {
      echo "<p><b>$sents_type_label</b> : $terms</p>";
    }
  }
}

/** 3 - Cacher les informations supplémentaires */

add_action('wp_head', function () {

?>
  <style>
    <?php echo join(", ", array_map(function ($sent_type) {
      return ".woocommerce-product-attributes-item--attribute_pa_$sent_type";
    }, array_keys(get_sents_types()))) ?> {
      display: none;
    }
  </style>
<?php
}, 100);
