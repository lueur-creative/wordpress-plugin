<?php

/** Crée une metabox pour ajouter les informations concernant le poids en cire de la bougie et la durée de combustion */

/** 1 - Ajouter la metabox */

function ajouter_metabox_cire_et_duree()
{
  add_meta_box(
    'metabox_cire_et_duree',
    __('Durée de combustion', 'textdomain'),
    'afficher_metabox_cire_et_duree',
    'product',
    'side',
    'default'
  );
}
add_action('add_meta_boxes', 'ajouter_metabox_cire_et_duree');

function afficher_metabox_cire_et_duree($post)
{
  wp_nonce_field(basename(__FILE__), 'cire_et_duree_nonce');
  $poids_cire = get_post_meta($post->ID, '_poids_cire', true);
  $duree_combustion = get_post_meta($post->ID, '_duree_combustion', true);
?>
  <p>
    <label for="poids_cire"><?php _e('Poids de cire (g)', 'textdomain'); ?></label>
    <input type="number" id="poids_cire" name="poids_cire" value="<?php echo esc_attr($poids_cire); ?>" />
  </p>
  <p>
    <label for="duree_combustion"><?php _e('Durée de combustion (heures)', 'textdomain'); ?></label>
    <input type="number" id="duree_combustion" name="duree_combustion" value="<?php echo esc_attr($duree_combustion); ?>" />
  </p>
<?php
}

/** 2 - Enregistrer la metabox */

function enregistrer_metabox_cire_et_duree($post_id)
{
  // Vérifie le nonce pour la sécurité.
  if (!isset($_POST['cire_et_duree_nonce']) || !wp_verify_nonce($_POST['cire_et_duree_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // Vérifie l'autorisation de l'utilisateur.
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  if ('product' !== $_POST['post_type'] || !current_user_can('edit_post', $post_id)) {
    return $post_id;
  }

  // Sauvegarde les données.
  $poids_cire = isset($_POST['poids_cire']) ? sanitize_text_field($_POST['poids_cire']) : '';
  $duree_combustion = isset($_POST['duree_combustion']) ? sanitize_text_field($_POST['duree_combustion']) : '';

  update_post_meta($post_id, '_poids_cire', $poids_cire);
  update_post_meta($post_id, '_duree_combustion', $duree_combustion);
}
add_action('save_post', 'enregistrer_metabox_cire_et_duree');

/** 3 - Afficher les informations sur la fiche du produit */

function add_product_combustion_duration_tab($tabs)
{
  /** @var WC_Product $product */
  global $product;

  $poids_cire = $product->get_attribute("pa_quantite-cire");
  $duree_combustion = $product->get_attribute("pa_duree-combustion");

  if ($poids_cire || $duree_combustion) {
    $tabs['wax'] = array(
      'title' => "Durée d'utilisation",
      'priority' => 15, // TAB SORTING (DESC 10, ADD INFO 20, REVIEWS 30)
      'callback' => 'add_product_combustion_duration_tab_content', // TAB CONTENT CALLBACK
    );
  }

  return $tabs;
}
add_filter('woocommerce_product_tabs', 'add_product_combustion_duration_tab', 50);


function add_product_combustion_duration_tab_content()
{
  /** @var WC_Product $product */
  global $product;

  $poids_cire = $product->get_attribute("pa_quantite-cire");
  $duree_combustion = $product->get_attribute("pa_duree-combustion");

  echo "La bougie contient <b>$poids_cire</b> de cire soit <b>± $duree_combustion</b> d'utilisation";
}

/** 4 - Cacher les attributs du front */
/**
 * Add color styling from settings
 * Inserted with an enqueued CSS file
 */

add_action('wp_head', function () {
?>
  <style>
    .woocommerce-product-attributes-item--attribute_pa_quantite-cire,
    .woocommerce-product-attributes-item--attribute_pa_duree-combustion {
      display: none;
    }
  </style>
<?php
}, 100);
