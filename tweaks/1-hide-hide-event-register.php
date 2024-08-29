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
  
/* add_filter( 'submit_event_form_fields', 'show_hide_registration_button' );
function show_hide_registration_button( $fields) {  
      
    $fields['event']['show_hide_registration_button'] =  array(
                                        'label'       => __( 'Show Hide Registration Button', 'wp-event-manager-registrations' ),
                                        'type'        => 'checkbox',
                                        'required'    => false,
                                        'priority'    => 22,
                                   );
    return $fields;
} */