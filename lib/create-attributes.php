<?php

// Fonction pour vérifier et créer l'attribut si nécessaire
function ensure_attribute_exists($attribute_name, $attribute_label, $has_archive = false)
{
  // Récupérer tous les attributs existants
  $existing_attributes = wc_get_attribute_taxonomies();

  // Vérifier si l'attribut existe déjà
  foreach ($existing_attributes as $attribute) {
    if ($attribute->attribute_name === wc_sanitize_taxonomy_name($attribute_name)) {
      return $attribute->attribute_id; // L'attribut existe déjà, renvoyer son ID
    }
  }

  // L'attribut n'existe pas, le créer
  $attribute_id = wc_create_attribute(array(
    'name'         => $attribute_label,
    'slug'         => wc_sanitize_taxonomy_name($attribute_name),
    'type'         => 'select',
    'order_by'     => 'menu_order',
    'has_archives' => $has_archive,
  ));

  if (! is_wp_error($attribute_id)) {
    return $attribute_id; // L'attribut a été créé avec succès
  } else {
    return null; // Erreur lors de la création de l'attribut
  }
}
