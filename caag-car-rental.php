<?php
/*
 * @package Caag Car Rental
 * @version 1.0
 *
 *
Plugin Name:  Caag Car Rental
Plugin URI:   https://caagsoftware.com
Description:  Display Car Rental Forms
Version:      1.0
Author:       Miguel Faggioni
Author URI:   https://caagsoftware.com
*/


/*
 * Global Constant
 */
define('CAAG_RENTAL_VERSION','1.0');
define('CAAG_RENTAL_POST_TYPE','caag-rental-form');
define('CAAG_RENTAL_ROOT',__DIR__);
define('CAAG_RENTAL_PLUGIN_FOLDER','caag-car-rental');

/*
 * Plugin Variables
 */
define('CAAG_RENTAL_USER_TOKEN','caag_rental_user_token');
define('CAAG_RENTAL_TENANT_TOKEN','caag_rental_tenant_token');
define('CAAG_RENTAL_CUSTOM_POST_TYPE','caag_rental_forms');
define('CAAG_RENTAL_API_GET_CALLS','https://api.caagcrm.com/api/fleets/brands');
/*
 * Meta Values
 */
define('CAAG_RENTAL_CAAG_ID','caag_rental_id');
define('CAAG_RENTAL_NAME','caag_rental_name');
define('CAAG_RENTAL_LINK','caag_rental_link');
define('CAAG_RENTAL_SHORTCODE','caag_rental_shortcode');
define('CAAG_RENTAL_FIRST_STEP_LINK','caag_rental_first_step_link');
/*
 * Meta Values Columns Name
 */
define('CAAG_RENTAL_ID_COLUMN','Id');
define('CAAG_RENTAL_NAME_COLUMN','Name');
define('CAAG_RENTAL_LINK_COLUMN','Link');
define('CAAG_RENTAL_SHORTCODE_COLUMN','Shortcode');

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
