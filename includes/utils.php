<?php

/*
 * Register and Enqueue Caag Rental Styles
 * @return void
 */
function caag_hq_rental_styles()
{
    wp_register_style('caag-rental', plugin_dir_url(__FILE__) . '../assets/css/caag_hq_rental.css');
    wp_enqueue_style('caag-rental');
}

add_action('caag_hq_rental_styles', 'caag_hq_rental_styles');

/*
 * Load Plugin Js Files
 * return void
 */
function caag_hq_rental_scripts()
{
    wp_register_script('caag-rental-iframe-resize',
        plugin_dir_url(__FILE__) . '../assets/js/iframeSizer.min.js?version=3.5.15');
    wp_register_script('caag-rental-iframe-init', plugin_dir_url(__FILE__) . '../assets/js/caagResize.js', ['jquery']);
    wp_enqueue_script('caag-rental-iframe-resize');
    wp_enqueue_script('caag-rental-iframe-init');
}

add_action('wp_enqueue_script', 'caag_hq_rental_scripts');


/*
 * Loading Inline Js Submit Script
 * return void
*/
function caag_hq_rental_inline_script()
{
    wp_enqueue_script('caag-rental-script-submit', plugin_dir_url(__FILE__) . '../assets/js/submit.js?timestamp=' . time(),
        ['jquery']);
}

add_action('wp_enqueue_script', 'caag_hq_rental_inline_script');


/*
 * Retrieves Caag Rental Users Settings
 * @return Array
 */
function get_caag_hq_rental_user_settings()
{
    $settings = array(
        CAAG_HQ_RENTAL_TENANT_TOKEN => get_option(CAAG_HQ_RENTAL_TENANT_TOKEN),
        CAAG_HQ_RENTAL_USER_TOKEN => get_option(CAAG_HQ_RENTAL_USER_TOKEN)
    );

    return $settings;
}

add_action('get_caag_hq_rental_user_settings', 'get_caag_hq_rental_user_settings');

/*
 * Retrieves Caag Rental User Token
 * @return String
 */
function get_caag_hq_rental_user_token()
{
    return get_option(CAAG_HQ_RENTAL_USER_TOKEN);
}

add_action('get_caag_hq_rental_user_token', 'get_caag_hq_rental_user_token');

/*
 * Retrieves Caag Rental Tenant Token
 * @return String
 */
function get_caag_hq_rental_tenant_token()
{
    return get_option(CAAG_HQ_RENTAL_TENANT_TOKEN);
}

add_action('get_caag_hq_rental_tenant_token', 'get_caag_hq_rental_tenant_token');


/*
 * Checks if the Caag Forms Exists
 * @param int | caag id
 * @return boolean
 */
function caag_hq_rental_exists($caag_id)
{
    return !empty(get_caag_hq_rental_by_meta($caag_id));
}

add_action('caag_hq_rental_exists', 'caag_hq_rental_exists');


/*
 * Retrieves post id for a meta Id
 * @param int | meta Id
 * @return Array
 */
function get_caag_hq_rental_by_meta($caag_id)
{
    global $wpdb;
    $post_id = $wpdb->get_results('SELECT post_id FROM ' . $wpdb->prefix . 'postmeta WHERE meta_value = ' . $caag_id .
                                  ' and meta_key = "' . CAAG_HQ_RENTAL_CAAG_ID . '"');

    return $post_id;
}

add_action('get_caag_hq_rental_by_meta', 'get_caag_hq_rental_by_meta');

/*
 * Retrieve the Rental Link
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_link($caag_id)
{
    $post = get_caag_hq_rental_by_meta($caag_id);

    return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_LINK)[0];
}

add_action('get_caag_hq_rental_link', 'get_caag_hq_rental_link');

/*
 * Retrieve the Package Link
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_first_step_link($caag_id)
{
    $post = get_caag_hq_rental_by_meta($caag_id);

    return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK)[0];
}

add_action('get_caag_hq_rental_first_step_link', 'get_caag_hq_rental_first_step_link');

/*
 * Retrieve the Package Link
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_package_link($caag_id)
{
    $post = get_caag_hq_rental_by_meta($caag_id);

    return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_PUBLIC_PACKAGES_LINK)[0];
}

add_action('get_caag_hq_rental_package_link', 'get_caag_hq_rental_package_link');

/*
 * Retrieve the Package First Step Link
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_package_first_step_link($caag_id)
{
    $post = get_caag_hq_rental_by_meta($caag_id);

    return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK_PACKAGES[0]);
}

/*
 * Retrieve the My Reservation
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_my_reservation_link($caag_id)
{
	$post = get_caag_hq_rental_by_meta($caag_id);
	return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_MY_RESERVATION_LINK)[0];
}
add_action('get_caag_hq_rental_my_reservation_link','get_caag_hq_rental_my_reservation_link');

/*
 * Retrieve the My Reservation + Package Link
 * @param int | Caag CRM id
 * @return int
 */
function get_caag_hq_rental_my_package_reservation_link($caag_id)
{
	$post = get_caag_hq_rental_by_meta($caag_id);
	return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_MY_PACKAGE_RESERVATION_LINK)[0];
}
add_action('get_caag_hq_rental_my_package_reservation_link','get_caag_hq_rental_my_package_reservation_link');

/*
 * 
 */
function get_caag_hq_rental_reservation_package_link($caag_id)
{
    $post = get_caag_hq_rental_by_meta($caag_id);

    return get_post_meta($post[0]->post_id, CAAG_HQ_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK)[0];
}
add_action('get_caag_hq_rental_reservation_package_link','get_caag_hq_rental_reservation_package_link');