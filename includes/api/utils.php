<?php

/*
 * Get Locations Api Endpoint
 */
function caag_hq_get_location_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/locations';
}

/*
 * Get Rates Api Endpoint
 */
function caag_hq_get_rates_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'car-rental/rates';
}

function caag_hq_get_seasons_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'car-rental/seasons';
}


/*
 *  Get Vehicle Classes Api Endpoint
 */
function caag_hq_get_vehicle_classes_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/vehicle-classes';
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

/*
 * Get Basic Arguments for Api Calls
 */
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

/*
 * Get Locations Classes Custom Posts
 */
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


/*
 * Get Rates Custom Posts
 */
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


/*
 * Get Vehicle Classes Custom Posts
 */
function caag_hq_get_vehicle_classes_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'meta_key'          =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

function caag_hq_get_seasons_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS,
        'post_status'       =>  'publish',
        'meta_key'          =>  CAAG_HQ_RENTAL_SEASON_ID_META
    );
    $query = new WP_Query( $args );
    return $query->posts;
}