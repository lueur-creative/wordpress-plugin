<?php

/** Ajoute les étiquettes note de tête/coeur/fond et un onglet supplémentaire sur la fiche produit */

function get_sents_types()
{
  return ["tete" => "tête", "coeur" => "cœur", "fond" => "fond"];
}

// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_sents_taxonomies', 0);

function get_labels(String $type)
{
  return [
    'name'                       => "Notes de $type",
    'singular_name'              => "Note de $type",
    'search_items'               => "Chercher une note de $type",
    'popular_items'              => "Note de $type populaire",
    'all_items'                  => "Toutes les notes de $type",
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => "Modifier la note de $type",
    'update_item'                => "Mettre à jour la note de $type",
    'add_new_item'               => "Ajouter une note de $type",
    'new_item_name'              => "Nom de la nouvelle note de $type",
    'separate_items_with_commas' => "Séparer les notes de $type avec une virgule",
    'add_or_remove_items'        => "Ajouter ou supprimer une note de $type",
    'choose_from_most_used'      => "Choisir parmi les notes de $type les plus utilisées",
    'not_found'                  => "Aucune note de $type trouvée",
    'menu_name'                  => "Note de $type",
  ];
}

function create_sents_taxonomies()
{
  foreach (get_sents_types() as $sents_type_slug => $sents_type) {

    $args = array(
      'hierarchical'      => false,
      'labels'            => get_labels($sents_type),
      'show_ui'           => true,
      'show_admin_column' => false,
      'query_var'         => true,
      "rewrite" => ["slug" => "note-$sents_type_slug"]
    );

    register_taxonomy("sent_$sents_type_slug", array('product'), $args);
  }
}



function add_product_sents_tab($tabs)
{
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
  global $product;
  foreach (get_sents_types() as $sents_type_slug => $sents_type) {
    $terms = get_the_term_list($product->get_id(), "sent_$sents_type_slug", "", ", ");
    if (strlen($terms) > 0) {
      echo "<p><b>Note de $sents_type</b> : $terms</p>";
    }
  }
}
