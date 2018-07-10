<?php

/*
 * Get Locations Api Endpoint
 */
function caag_hq_get_location_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/locations';
}

/*
 *
 */
function caag_hq_get_rates_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'car-rental/rates';
}

/*
 * API Call Handler
 *
 */
function caag_hq_api_call_handler( $response )
{
    if ( is_wp_error( $response ) ) {
        return $error_message = $response->get_error_message();
    } else {
        return $response;
    }
}

function caag_hq_api_get_basic_header()
{
    $tenant = get_caag_hq_rental_tenant_token();
    $user = get_caag_hq_rental_user_token();
    $final_token = base64_encode($tenant . ':' . $user);
    $args = array(
        'headers' => array(
            'Authorization' => 'Basic ' . $final_token
        )
    );
    return $args;
}

/*
 * Get Brands Api Endpoint
 */
function caag_hq_get_brands_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/brands';
}

function caag_hq_get_locations_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
        'post_status'       =>  'publish',
        'meta_key'          =>  CAAG_HQ_RENTAL_LOCATION_ID_META
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

function caag_hq_get_rates_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_RATES,
        'post_status'       =>  'publish',
        'meta_key'          =>  CAAG_HQ_RENTAL_RATE_ID_META
    );
    $query = new WP_Query( $args );
    return $query->posts;
}