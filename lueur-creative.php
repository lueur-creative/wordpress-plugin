<?php
/*
 * Plugin Name: Lueur Créative Tweaks
 * Description: Personnalisation du site lueurcreative.fr
 * Author: Marin Roux
 */

if (! defined('ABSPATH')) {
  exit;
}

define("LUEURCREATIVE_BASE_PATH", __DIR__ . "/");

/** Import lib */

require_once LUEURCREATIVE_BASE_PATH . "lib/class-tgm-plugin-activation.php";
require_once LUEURCREATIVE_BASE_PATH . "lib/create-attributes.php";

/** Import required plugins */

require_once LUEURCREATIVE_BASE_PATH . "required-plugins.php";

/** Import tweaks */

require_once LUEURCREATIVE_BASE_PATH . "tweaks/0-add-product-image-notice.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/1-hide-hide-event-register.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/2-use-event-date-as-expiration.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/3-add-sents-tab.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/4-add-security-infos.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/5-allow-on-product-cat.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/6-make-product-image-square.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/7-add-metabox-product-duration.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/8-add-dashboard-metabox.php";
require_once LUEURCREATIVE_BASE_PATH . "tweaks/9-pickup-work-hours-email-translation.php";
