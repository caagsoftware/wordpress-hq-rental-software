<?php
/*
 * @package Caag Car Rental
 * @version 0.1
 *
 *
Plugin Name:  Caag Car Rental
Plugin URI:   https://caagsoftware.com
Description:  Car Rental Plugin - Check Description
Version:      0.1
Author:       Miguel Faggioni
Author URI:   https://caagsoftware.com
*/

/*
 * Global Constant
 */
define('CAAG_RENTAL_VERSION','0.1');
define('CAAG_RENTAL_POST_TYPE','caag-rental-form');
define('CAAG_RENTAL_ROOT',__DIR__);
/*
 * Plugin Variables
 */
define('CAAG_RENTAL_USER_TOKEN','caag_rental_user_token');
define('CAAG_RENTAL_TENANT_TOKEN','caag_rental_tenant_token');

define('CAAG_RENTAL_SETTING_TITLE','Caag Rental');
define('CAAG_RENTAL_SETTING_MENU','Caag Rental');
define('CAAG_RENTAL_SLUG','caag-rental');
define('CAAG_RENTAL_NONCE', 'caag_nonce');
/*
 * Require Files
 */
require_once 'includes/settings.php';
require_once 'includes/utils.php';

/*
 * Activation Routine
 * @return void
 */
function caag_rental_activation()
{
	caag_rental_settings_init();
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



