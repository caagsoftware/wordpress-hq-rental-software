<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/12/2017
 * Time: 9:41 PM
 */

/*
 * Register and Enqueue Caag Rental Styles
 * @return void
 */
function caag_rental_styles()
{
	wp_register_style('caag-rental', plugins_url(CAAG_RENTAL_PLUGIN_FOLDER.'/assets/css/caag.css'));
	wp_enqueue_style('caag-rental');
}
add_action('caag_rental_styles','caag_rental_styles');


/*
 * Retrieves Caag Rental Users Settings
 * @return Array
 */
function get_caag_rental_user_settings()
{
	$settings = array(
		CAAG_RENTAL_TENANT_TOKEN    =>  get_option(CAAG_RENTAL_TENANT_TOKEN),
		CAAG_RENTAL_USER_TOKEN      =>  get_option(CAAG_RENTAL_USER_TOKEN)
	);
	return $settings;
}
add_action('get_caag_rental_user_settings','get_caag_rental_user_settings');

/*
 * Retrieves Caag Rental User Token
 * @return String
 */
function get_caag_rental_user_token()
{
	return get_option(CAAG_RENTAL_USER_TOKEN);
}
add_action('get_caag_rental_user_token','get_caag_rental_user_token');

/*
 * Retrieves Caag Rental Tenant Token
 * @return String
 */
function get_caag_rental_tenant_token()
{
	return get_option(CAAG_RENTAL_TENANT_TOKEN);    
}
add_action('get_caag_rental_tenant_token','get_caag_rental_tenant_token');