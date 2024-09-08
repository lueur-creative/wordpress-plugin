<?php

/** Ajoute un widget sur le tableau de bord avec des liens et des astuces pour Lucie */

function lueurcreative_add_dashboard_widget()
{
  wp_add_dashboard_widget(
    'lueurcreative_add_dashboard_widget',
    'Tips pour Lucie',
    'lueurcreative_display_dashboard_widget'
  );
}
add_action('wp_dashboard_setup', 'lueurcreative_add_dashboard_widget');

function lueurcreative_display_dashboard_widget()
{
?>
  <div>
    <h3>Produits</h3>
    <ul>
      <li>
        <a href="/wp-admin/post-new.php?post_type=product">Ajouter un produit</a>
      </li>
      <li>
        <a href="/wp-admin/edit.php?post_type=product">Modifier les produits</a>
      </li>
      <li>
        <a href="/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product">Modifier les informations de sécurité et d'utilisation</a>
        <br />
        → Clique sur la catégorie à modifier puis modifier le texte sur la page
        <br />
        <em style="font-size:x-small;">Les informations de la catégorie parente s'affichent en premier puis les informations de la catégorie. </em>
      </li>
    </ul>
    <h3>Page d'accueil</h3>
    <ul>
      <li>
        <a href="/wp-admin/edit.php?post_type=event_listing">Gérer les événements sur la page d'accueil</a>
      </li>
      <li>
        Produits affichés : Produits avec une étoile
      </li>
    </ul>
    <h3>Modifier les autres pages</h3>
    <ul>
      <li>
        <a href="/wp-admin/post.php?post=14&action=edit">Nos produits</a>
      </li>
      <li>
        <a href="/wp-admin/post.php?post=17&action=edit">À propos</a>
      </li>
      <li>
        <a href="/wp-admin/post.php?post=736&action=edit">Réglementation CLP et allergènes</a>
      </li>
    </ul>
  </div>
<?php
}
