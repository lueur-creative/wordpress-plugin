<?php

function lueurcreative_register_required_plugins()
{
  /*
     * Liste des plugins que vous voulez rendre obligatoires ou recommandés.
     */
  $plugins = [
    [
      'name'      => 'Advanced Local Pickup for WooCommerce',
      'slug'      => 'advanced-local-pickup-for-woocommerce',
      'required'  => true,
    ],
    [
      'name'      => 'Colissimo Shipping Methods for WooCommerce',
      'slug'      => 'colissimo-shipping-methods-for-woocommerce',
      'required'  => true,
    ],
    [
      'name'      => 'Contact Form 7',
      'slug'      => 'contact-form-7',
      'required'  => true,
    ],
    [
      'name'      => 'Flamingo',
      'slug'      => 'flamingo',
      'required'  => true,
    ],
    [
      'name'      => 'Jetpack',
      'slug'      => 'jetpack',
      'required'  => true,
    ],
    [
      'name'      => 'Jetpack boost',
      'slug'      => 'jetpack-boost',
    ],
    [
      'name'      => 'LiteSpeed Cache',
      'slug'      => 'litespeed-cache',
    ],
    [
      'name'      => 'MailPoet',
      'slug'      => 'mailpoet',
      'required'  => true,
    ],
    [
      'name'      => 'Redis Cache',
      'slug'      => 'redis-cache',
    ],
    [
      'name'      => 'Sumup Payment Gateway for WooCommerce',
      'slug'      => 'sumup-payment-gateway-for-woocommerce',
      'required'  => true,
    ],
    [
      'name'      => 'Updraft Plus',
      'slug'      => 'updraftplus',
      'required'  => true,
    ],
    [
      'name'      => 'WooCommerce',
      'slug'      => 'woocommerce',
      'required'  => true,
    ],
    [
      'name'      => 'WooCommerce PDF Invoices',
      'slug'      => 'woocommerce-pdf-invoices-packing-slips',
      'required'  => true,
    ],
    [
      'name'      => 'WP Event Manager',
      'slug'      => 'wp-event-manager',
      'required'  => true,
    ],
    [
      'name'      => 'WPSEOPress',
      'slug'      => 'wp-seopress',
      'required'  => true
    ],
    [
      'name'      => 'WP SMTP',
      'slug'      => 'wp-smtp',
      'required'  => true,
    ],
  ];

  /*
     * Configuration des options de la classe TGM Plugin Activation.
     */
  $config = array(
    'id'           => 'lueur-creative',                 // Identifiant unique pour TGM
    'default_path' => '',                          // Chemin par défaut pour les plugins locaux
    'menu'         => 'tgmpa-install-plugins',     // Slug de la page d'installation des plugins
    'has_notices'  => true,                        // Afficher les notifications
    'dismissable'  => false,                       // Les notifications peuvent être rejetées
    'is_automatic' => false,                       // Plugin activé automatiquement après l'installation
    'message'      => '',                          // Message en haut de la page TGMPA
  );

  tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'lueurcreative_register_required_plugins');
