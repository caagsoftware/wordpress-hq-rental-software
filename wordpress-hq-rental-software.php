<?php
/*
 * @package Wordpress HQ Rental Software
 * @version 1.0.0.1
 *
 *
Plugin Name:  HQ Rental
Description:  HQ Rental Software
Version:      1.0.0.1
Author:       HQ Rental Software
Author URI:   https://www.hqrentalsoftware.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.html
*/


/*
 * Global Constant
 */
define('CAAG_HQ_RENTAL_VERSION','1.0.0.1');
define('CAAG_HQ_RENTAL_POST_TYPE','caag-rental-form');


/*
 * Plugin Settings Variables
 */
define('CAAG_HQ_RENTAL_USER_TOKEN','caag_hq_rental_user_token');
define('CAAG_HQ_RENTAL_TENANT_TOKEN','caag_hq_rental_tenant_token');
define('CAAG_HQ_RENTAL_DATE_FORMAT','caag_hq_rental_date_format');
define('CAAG_HQ_RENTAL_API_END_POINT','caag_hq_rental_api_end_point');
define('CAAG_HQ_RENTAL_SAFARI_BROWSER', 'caag_hq_rental_safari_browser');
define('CAAG_HQ_RENTAL_CURRENT_BRAND_SELECTED', 'caag_hq_rental_current_brand_selected');

/*
 * Meta Values Keys
 */
define('CAAG_HQ_RENTAL_CAAG_ID','caag_hq_rental_id');
define('CAAG_HQ_RENTAL_NAME','caag_hq_rental_name');
define('CAAG_HQ_RENTAL_LINK','caag_hq_rental_link');
define('CAAG_HQ_RENTAL_SHORTCODE','caag_hq_rental_shortcode');
define('CAAG_HQ_RENTAL_FIRST_STEP_LINK', 'caag_hq_rental_first_step_link');
define('CAAG_HQ_RENTAL_SHORTCODE_PACKAGES','caag_hq_rental_shortcode_package');
define('CAAG_HQ_RENTAL_PUBLIC_PACKAGES_LINK', 'caag_hq_rental_public_package_link');
define('CAAG_HQ_RENTAL_FIRST_STEP_LINK_PACKAGES', 'caag_hq_rental_first_step_link_packages');
define('CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES', 'caag_hq_rental_shortcode_reservation_packages');
define('CAAG_HQ_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK', 'caag_hq_rental_public_reservation_package_link');
define('CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION', 'caag_hq_rental_shortcode_my_reservation');
define('CAAG_HQ_RENTAL_MY_RESERVATION_LINK', 'caag_hq_rental_public_my_reservation_link');
define('CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION', 'caag_hq_rental_shortcode_my_package_reservation');
define('CAAG_HQ_RENTAL_MY_PACKAGE_RESERVATION_LINK', 'caag_hq_rental_public_my_package_reservation_link');

/*
 * Meta Values Columns Name - Admin Table
 */
define('CAAG_HQ_RENTAL_ID_COLUMN','Id');
define('CAAG_HQ_RENTAL_NAME_COLUMN','Name');
define('CAAG_HQ_RENTAL_LINK_COLUMN','Link');
define('CAAG_HQ_RENTAL_SHORTCODE_COLUMN','Shortcode Reservations');
define('CAAG_HQ_RENTAL_SHORTCODE_PACKAGES_COLUMN','Shortcode Packages');
define('CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN','Shortcode Reservation + Packages');
define('CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION_COLUMN','Shortcode My Reservations');
define('CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION_COLUMN','Shortcode My Packages + Reservations');
/*
 * Security and Decoration Variables
 */
define('CAAG_HQ_RENTAL_SETTING_TITLE','HQ Rental Setup');
define('CAAG_HQ_RENTAL_SETTING_MENU','HQ Rental Setup');
define('CAAG_HQ_RENTAL_SLUG','caag-rental');
define('CAAG_HQ_RENTAL_NONCE', 'caag_nonce');

/*
 * Require Files
 */
require_once('includes/init.php');


/*
 * Activation Routine
 * @return void
 */
function caag_hq_rental_activation()
{
	caag_hq_rental_settings_init();
	register_caag_hq_rental_custom_post_type();
}
register_activation_hook(__FILE__,'caag_hq_rental_activation');

/*
 * Deactivation Routine
 * @return void
 */
function caag_hq_rental_deactivation()
{
	// Do nothing
}
register_deactivation_hook(__FILE__,'caag_hq_rental_deactivation');

