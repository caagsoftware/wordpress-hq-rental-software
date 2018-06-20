<?php

/*
 * Retrieves Caag Rental Users Settings
 * @return Array
 */
function get_caag_hq_rental_user_settings()
{
    $settings = array(
        CAAG_HQ_RENTAL_TENANT_TOKEN => get_option(CAAG_HQ_RENTAL_TENANT_TOKEN),
        CAAG_HQ_RENTAL_USER_TOKEN => get_option(CAAG_HQ_RENTAL_USER_TOKEN),
        CAAG_HQ_RENTAL_SAFARI_BROWSER => get_option(CAAG_HQ_RENTAL_SAFARI_BROWSER)
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

/*
 *
 */
function caag_hq_rental_safari_option()
{
    return get_option(CAAG_HQ_RENTAL_SAFARI_BROWSER) == '1';
}
/*
 * Return POST array value by key
 * @string key
 * @var value
 */
function get_data_from_post_var($data)
{
    return $_POST[$data];
}

/*
 * Return Api Endpoint
 * @var value
 */
function caag_hq_rental_get_api_endpoint()
{
    return get_option(CAAG_HQ_RENTAL_API_END_POINT);
}

function caag_hq_rental_get_form_refresh_endpoint()
{
    return get_option(CAAG_HQ_RENTAL_API_END_POINT) . 'fleets/brands';
}

function caag_hq_get_forms()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_TYPE
    );
    $query = new WP_Query($args);
    return $query->posts;
}

/*
 * Check if Safari Browser and redirect in case of true
 */
function caag_hq_rental_check_for_safari_browser()
{
    global $is_safari;
    global $post;
    $post_request_data = $_POST;
    if( !$is_safari ){
        if(strpos($post->post_content, 'hq_rental_reservation_form') !== false){
            $strings = explode( 'hq_rental_reservation_form', $post->post_content );
            $caag_id = substr(trim($strings[1]),3,1);
            $first_step = get_caag_hq_rental_first_step_link($caag_id);
            foreach ($post_request_data as $key => $value){
                $first_step .= '&' .$key. '=' . $value;
            }
            wp_redirect($first_step);
            exit;
        }elseif (strpos($post->post_content, 'hq_rental_forms_packages') !== false){
            $strings = explode( 'hq_rental_forms_packages', $post->post_content );
            $caag_id = substr(trim($strings[1]),3,1);
            $first_step = get_caag_hq_rental_package_link($caag_id);
            foreach ($post_request_data as $key => $value){
                $first_step .= '&' .$key. '=' . $value;
            }
            wp_redirect($first_step);
            exit;
        }elseif (strpos($post->post_content, 'hq_rental_forms_reservation_packages') !== false){
            $strings = explode( 'hq_rental_forms_reservation_packages', $post->post_content );
            $caag_id = substr(trim($strings[1]),3,1);
            $first_step = get_caag_hq_rental_reservation_package_link($caag_id);
            foreach ($post_request_data as $key => $value){
                $first_step .= '&' .$key. '=' . $value;
            }
            wp_redirect($first_step);
            exit;
        }elseif (strpos($post->post_content, 'hq_rental_forms_my_reservations') !== false){
            $strings = explode( 'hq_rental_forms_my_reservations', $post->post_content );
            $caag_id = substr(trim($strings[1]),3,1);
            $first_step = get_caag_hq_rental_my_reservation_link($caag_id);
            foreach ($post_request_data as $key => $value){
                $first_step .= '&' .$key. '=' . $value;
            }
            wp_redirect($first_step);
            exit;
        }elseif (strpos($post->post_content, 'hq_rental_forms_my_package_reservation') !== false){
            $strings = explode( 'hq_rental_forms_my_package_reservation', $post->post_content );
            $caag_id = substr(trim($strings[1]),3,1);
            $first_step = get_caag_hq_rental_my_package_reservation_link($caag_id);
            foreach ($post_request_data as $key => $value){
                $first_step .= '&' .$key. '=' . $value;
            }
            wp_redirect($first_step);
            exit;
        }
    }
}
add_action('template_redirect', 'caag_hq_rental_check_for_safari_browser');