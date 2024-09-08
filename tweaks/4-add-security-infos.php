<?php

/** Ajout des informations de sécurité à la page d'un produit */

/** 1 - Ajouter un champ WYSIWYG dans les catégories produit */

// Ajouter le champ WYSIWYG dans le formulaire d'édition des catégories
function ajouter_champ_wysiwyg_dans_categories($term)
{
  // Récupérer la valeur sauvegardée
  $use = get_term_meta($term->term_id, 'category_use', true);
  $security = get_term_meta($term->term_id, 'category_security', true);

  // Afficher le champ WYSIWYG
?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="category_use"><?php _e('Utilisation'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($use, 'category_use', array(
        'textarea_name' => 'category_use',
        'media_buttons' => false,
        'textarea_rows' => 10,
        'teeny' => false,
        'quicktags' => false,
      ));
      ?>
      <p class="description"><?php _e("Ajouter des informations sur l'utilisation."); ?></p>
      <p class="description"><?php _e("Les informations de sécurité de la catégorie parente s'afficheront également. "); ?></p>
    </td>
  </tr>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="category_security"><?php _e('Sécurité et utilisation'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($security, 'category_security', array(
        'textarea_name' => 'category_security',
        'media_buttons' => false,
        'textarea_rows' => 10,
        'teeny' => false,
        'quicktags' => false,
      ));
      ?>
      <p class="description"><?php _e('Ajouter une information de sécurité pour la catégorie.'); ?></p>
      <p class="description"><?php _e("Les informations de sécurité de la catégorie parente s'afficheront également. "); ?></p>
    </td>
  </tr>
<?php
}
add_action('product_cat_edit_form_fields', 'ajouter_champ_wysiwyg_dans_categories', 5, 2);

// Sauvegarder la valeur du champ WYSIWYG pour la catégorie de produit
function sauvegarder_category_security_produit($term_id)
{
  if (isset($_POST['category_security'])) {
    update_term_meta($term_id, 'category_security', wp_kses_post($_POST['category_security']));
  }
  if (isset($_POST['category_use'])) {
    update_term_meta($term_id, 'category_use', wp_kses_post($_POST['category_use']));
  }
}
add_action('edited_product_cat', 'sauvegarder_category_security_produit', 10, 2);

/** 2 - Afficher les informations dans les fiches produit */

function extract_infos_categories(int $category_id)
{
  $use = get_term_meta($category_id, 'category_use', true);
  $security = get_term_meta($category_id, 'category_security', true);

  return [
    "use" => $use,
    "security" => $security
  ];
}

add_action("woocommerce_after_single_product_summary", function () {
  /** @var WC_Product $product */
  global $product;

  $categories_parents = [];
  $categories_id = $product->get_category_ids();
  $categories = array_map(function ($category_id) use (&$categories_parents) {
    $category = get_term_by("id", $category_id, "product_cat");
    if ($category->parent) {
      $categories_parents[$category->parent] =
        extract_infos_categories($category->parent);
    }
    return extract_infos_categories($category->term_id);
  }, $categories_id);

  $security = array_filter(
    array_map(function ($infos) {
      return $infos["security"];
    }, $categories_parents + $categories),
    fn($info) => $info && strlen($info) > 0
  );
  $use = array_filter(
    array_map(function ($infos) {
      return $infos["use"];
    }, $categories_parents + $categories),
    fn($info) => $info && strlen($info) > 0
  );
?>
  <div style="margin-bottom:4em;">
    <?php
    if (count($use) > 0) {
      echo "<h2>Conseils d'utilisation</h2>";
      echo join("", $use);
    } ?>
  </div>
  <div style="margin-bottom:4em;">
    <?php
    if (count($security) > 0) {
      echo  "<h2>Conseils de sécurité</h2>";
      echo join("", $security);
    }
    ?>
  </div>
<?php
}, 15);
