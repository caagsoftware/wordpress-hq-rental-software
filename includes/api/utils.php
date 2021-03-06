<?php

/*
 * Get Locations Api Endpoint
 */
function caag_hq_get_brands_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/brands';
}

/*
 * Get Locations Api Endpoint
 */
function caag_hq_get_location_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/locations';
}

/*
 * Get Locations Api Endpoint
 */
function caag_hq_get_assets_endpoint()
{
    return 'https://api.caagcrm.com/api/assets/files';
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


function caag_hq_additional_charges_endpoint()
{
    return get_option( CAAG_HQ_RENTAL_API_END_POINT ) . 'fleets/additional-charges';
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
 * Get Brands Custom Posts
 */
function caag_hq_get_brands_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

/*
 * Get Locations Classes Custom Posts
 */
function caag_hq_get_locations_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1
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
        'posts_per_page'    =>  -1
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
        'posts_per_page'    =>  -1
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

function caag_hq_get_additional_charges_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

function caag_hq_get_features_from_vehicle_class_post_on_website($vehicle_class_post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
                array(
                    'key'               =>  CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_POST_ID_META,
                    'value'             =>  $vehicle_class_post_id,
                    'compare'           =>  '=',
                    'posts_per_page'    =>  -1,
                )
        )
    );
    $query = new WP_Query( $args );
    return $query->posts;
}
function caag_hq_get_vehicles_images_on_website($vehicle_class_post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            array(
                'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META,
                'value'             =>  $vehicle_class_post_id,
                'compare'           =>  '=',
                'posts_per_page'    =>  -1,
            )
        )
    );
    $query = new WP_Query( $args );
    return $query->posts;
}


function caag_hq_get_vehicle_classes_ids_by_passengers_numbers( $passenger_number )
{
    $args = array(
        'post_type'     =>   CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'   =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
                array(
                    'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META,
                    'value'             =>  $passenger_number,
                    'compare'           =>  '='
                )
        )
    );
    $query = new WP_Query( $args );
    return $query->posts;
}

function caag_hq_get_seasons_on_website()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1
    );
    $query = new WP_Query( $args );
    return $query->posts;
}
function caag_hq_set_prices_with_taxes( $price, $tax ){
    $price_number = (float)number_format((float)$price,2);
    $tax_number = (float)number_format((float)$tax,2);
    return number_format( $price_number * ( 1 + ( $tax_number / 100.00 )), 2 );
}
function caag_hq_get_fontawesome_icon_tag($icon)
{
    if((strpos($icon, 'fas fa') !== false) or (strpos($icon, 'fab fa') !== false)){
        return $icon;
    }else{
        return 'fas fa-'. $icon;
    }
}


function caag_hq_get_date_format($format)
{
    return explode(' ',  $format)[0];
}
function caag_hq_get_time_format($format)
{
    return str_replace('A','',explode(' ',  $format)[1]);
}