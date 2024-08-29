<?php

/**
 * registration_limit_restriction
 * @param $method,$post
 * @return $method
 * @since 3.1.11
 */
function your_child_theme_registration_disable()
{
  // $disable_button = get_post_meta($post->ID,'_show_hide_registration_button',true);

  //disable button if settings in event meta box
  // if( $disable_button == 1){
  return false;
  // }else{
  //    return $method;
  // }
}

add_filter('display_event_registration_method', 'your_child_theme_registration_disable', 90, 2);
add_filter('get_event_registration_method', 'your_child_theme_registration_disable', 90, 2);


/** Cacher l'alerte de la page d'accueil si aucun événement est trouvé */

add_action('wp_head', function () {
?>
  <style>
    .no_event_listings_found {
      display: none;
    }
  </style>
<?php
}, 100);
