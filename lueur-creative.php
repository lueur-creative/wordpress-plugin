<?php
/*
 * Plugin Name: Lueur Créative Tweaks
 * Description: Personnalisation du site lueurcreative.fr
 * Author: Marin Roux
 */

if (! defined('ABSPATH')) {
  exit;
}

require_once "tweaks/0-add-product-image-notice.php";
require_once "tweaks/1-hide-hide-event-register.php";
require_once "tweaks/2-use-event-date-as-expiration.php";
require_once "tweaks/3-add-sents-tab.php";
require_once "tweaks/4-add-security-infos.php";
require_once "tweaks/5-allow-on-product-cat.php";
