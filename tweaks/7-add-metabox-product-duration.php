<?php

/** Crée une metabox pour ajouter les informations concernant le poids en cire de la bougie et la durée de combustion */

/** 1 - Créer les attributs */

function product_duration_create_wc_attribute_on_init()
{
  // Vérifiez si WooCommerce est actif avant d'exécuter le code
  if (class_exists('WooCommerce')) {
    // Assurez-vous que l'attribut est créé si nécessaire
    ensure_attribute_exists("wax-infos", "Poids");
  }
}
add_action('woocommerce_init', 'product_duration_create_wc_attribute_on_init');

/** 2 - Afficher les informations sur la fiche du produit */

function display_wax_infos()
{
  /** @var WC_Product $product */
  global $product;

  if ($product->is_type('variable')) {
    return;
  }

  $wax_variation = $product->get_attribute("pa_wax-infos");

  if (!$wax_variation || strlen($wax_variation === 0)) {
    return;
  }

  $weight_suffix =
    str_contains(wc_get_product_category_list($product->get_id()), "bougie") || str_contains(wc_get_product_category_list($product->get_id()), "fondant") ? " de cire" : "";
?>
  <form class="cart">
    <table class="variations" cellspacing="0" role="presentation">
      <tbody>
        <tr>
          <th class="label" style="line-height: 1rem;margin-bottom: 0;"><label for=" pa_wax-infos">Poids</label></th>
          <td class="value">
            <?php
            if (strpos($wax_variation, "/")) {
              [$wax_quantity, $wax_duration] = explode("/", $wax_variation);

              if ($wax_quantity) {
                if ($wax_duration) {
                  echo "$wax_quantity$weight_suffix (soit environ $wax_duration d'utilisation)";
                } else {
                  echo "$wax_quantity$weight_suffix";
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

/** 3 - Cacher les attributs du front */

add_action('wp_head', function () {
?>
  <style>
    .woocommerce-product-attributes-item--attribute_pa_wax-infos {
      display: none;
    }
  </style>
<?php
}, 100);

/** 4 - Personnaliser le dropdown */

function customizing_variations_terms_name($term_name, WP_Term | null $term)
{
  /** @var WC_Product $product */
  global $product;

  if (is_admin())
    return $term_name;

  if (!$product) {
    return $term_name;
  }

  $weight_suffix =
    str_contains(wc_get_product_category_list($product->get_id()), "bougie") || str_contains(wc_get_product_category_list($product->get_id()), "fondant") ? " de cire" : "";

  if ($term && $term->taxonomy === "pa_wax-infos") {
    if (strpos($term_name, "/")) {
      [$wax_quantity, $wax_duration] = explode("/", $term_name);

      if ($wax_quantity) {
        if ($wax_duration) {
          return "$wax_quantity$weight_suffix (soit environ $wax_duration)";
        } else {
          return $wax_quantity . $weight_suffix;
        }
      } elseif ($wax_duration) {
        return "Environ $wax_duration";
      }
    }
  }

  return $term_name;
}
add_filter('woocommerce_variation_option_name', 'customizing_variations_terms_name', 10, 4);
