<?php

/** Crée une metabox pour ajouter les informations concernant le poids en cire de la bougie et la durée de combustion */

/** 1 - Créer les attributs */

require_once __DIR__ . "/../lib/create-attributes.php";

function product_duration_create_wc_attribute_on_init()
{
  // Vérifiez si WooCommerce est actif avant d'exécuter le code
  if (class_exists('WooCommerce')) {
    // Assurez-vous que l'attribut est créé si nécessaire
    ensure_attribute_exists("wax-infos", "Poids de la bougie");
  }
}
add_action('woocommerce_init', 'product_duration_create_wc_attribute_on_init');

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

function display_wax_infos()
{
  /** @var WC_Product $product */
  global $product;

  if ($product->is_type('variable')) {
    return;
  }

  $wax_variation = $product->get_attribute("pa_wax-infos");
?>
  <form class="cart">
    <table class="variations" cellspacing="0" role="presentation">
      <tbody>
        <tr>
          <th class="label" style="line-height: 1rem;margin-bottom: 0;"><label for=" pa_wax-infos">Poids de la bougie</label></th>
          <td class="value">
            <?php
            if (strpos($wax_variation, "/")) {
              [$wax_quantity, $wax_duration] = explode("/", $wax_variation);

              if ($wax_quantity) {
                if ($wax_duration) {
                  echo "$wax_quantity de cire (soit environ $wax_duration d'utilisation)";
                } else {
                  echo "$wax_quantity de cire";
                }
              } elseif ($wax_duration) {
                echo "Environ $wax_duration d'utilisation";
              } else {
                echo $wax_variation;
              }
            } else {
              echo $wax_variation;
            }
            ?>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
<?php
}
add_filter('woocommerce_before_add_to_cart_form', 'display_wax_infos');

/** 4 - Cacher les attributs du front */

add_action('wp_head', function () {
?>
  <style>
    .woocommerce-product-attributes-item--attribute_pa_wax-infos {
      display: none;
    }
  </style>
<?php
}, 100);

/** 5 - Personnaliser le dropdown */

function customizing_variations_terms_name($term_name, WP_Term $term, $b, $c)
{
  if (is_admin())
    return $term_name;

  if ($term->taxonomy === "pa_wax-infos") {
    if (strpos($term_name, "/")) {
      [$wax_quantity, $wax_duration] = explode("/", $term_name);

      if ($wax_quantity) {
        if ($wax_duration) {
          return "$wax_quantity (soit environ $wax_duration)";
        } else {
          return $wax_quantity;
        }
      } elseif ($wax_duration) {
        return "Environ $wax_duration";
      }
    }
  }

  return $term_name;
}
add_filter('woocommerce_variation_option_name', 'customizing_variations_terms_name', 10, 4);
