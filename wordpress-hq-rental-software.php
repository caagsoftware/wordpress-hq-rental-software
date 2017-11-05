<?php
/*
 * @package Wordpress HQ Rental Software
 * @version 1.0
 *
 *
Plugin Name:  Wordpress HQ Rental Software
Description:  Display and Use Caag Software Car Rental Forms
Version:      1.0
Author:       Miguel Faggioni
Author URI:   https://www.caagsoftware.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.html
*/


/*
 * Global Constant
 */
$root = __DIR__;
$folders = explode('\\', $root);
$folder = $folders[count($folders) - 1];
define('CAAG_RENTAL_VERSION','1.0');
define('CAAG_RENTAL_POST_TYPE','caag-rental-form');
define('CAAG_RENTAL_ROOT', $root);
define('CAAG_RENTAL_PLUGIN_FOLDER', $folder);

/*
 * Plugin Variables
 */
define('CAAG_RENTAL_USER_TOKEN','caag_rental_user_token');
define('CAAG_RENTAL_TENANT_TOKEN','caag_rental_tenant_token');
define('CAAG_RENTAL_CUSTOM_POST_TYPE','caag_rental_forms');
define('CAAG_RENTAL_API_GET_CALLS','https://api.caagcrm.com/api/fleets/brands');

/*
 * Meta Values Keys
 */
define('CAAG_RENTAL_CAAG_ID','caag_rental_id');
define('CAAG_RENTAL_NAME','caag_rental_name');
define('CAAG_RENTAL_LINK','caag_rental_link');
define('CAAG_RENTAL_SHORTCODE','caag_rental_shortcode');
define('CAAG_RENTAL_FIRST_STEP_LINK', 'caag_rental_first_step_link');
define('CAAG_RENTAL_SHORTCODE_PACKAGES','caag_rental_shortcode_package');
define('CAAG_RENTAL_PUBLIC_PACKAGES_LINK', 'caag_rental_public_package_link');
define('CAAG_RENTAL_FIRST_STEP_LINK_PACKAGES', 'caag_rental_first_step_link_packages');
define('CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES', 'caag_rental_shortcode_reservation_packages');
define('CAAG_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK', 'caag_rental_public_reservation_package_link');

/*
 * Meta Values Columns Name - Admin Table
 */
define('CAAG_RENTAL_ID_COLUMN','Id');
define('CAAG_RENTAL_NAME_COLUMN','Name');
define('CAAG_RENTAL_LINK_COLUMN','Link');
define('CAAG_RENTAL_SHORTCODE_COLUMN','Shortcode Reservations');
define('CAAG_RENTAL_SHORTCODE_PACKAGES_COLUMN','Shortcode Packages');
define('CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN','Shortcode Reservation + Packages');

/*
 * Security and Decoration Variables
 */
define('CAAG_RENTAL_SETTING_TITLE','Caag Rental');
define('CAAG_RENTAL_SETTING_MENU','Caag Rental');
define('CAAG_RENTAL_SLUG','caag-rental');
define('CAAG_RENTAL_NONCE', 'caag_nonce');

/*
 * Require Files
 */
require_once 'includes/settings.php';
require_once 'includes/utils.php';
require_once 'includes/post-registration.php';
require_once 'includes/forms.php';
require_once 'includes/shortcodes.php';

/*
 * Activation Routine
 * @return void
 */
function caag_rental_activation()
{
	caag_rental_settings_init();
	register_caag_rental_custom_post_type();
}
register_activation_hook(__FILE__,'caag_rental_activation');

/*
 * Deactivation Routine
 * @return void
 */
function caag_rental_deactivation()
{
	// Do nothing
}
register_deactivation_hook(__FILE__,'caag_rental_deactivation');
