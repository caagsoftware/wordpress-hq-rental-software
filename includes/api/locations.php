<?php

/*
 * Scheduling the Cronjob
 */

/*
 * Location Custom Posts Metas Keys
 */
if ( ! wp_next_scheduled( 'caag_hq_locations_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_locations_update' );
}

/*
 *  Get Locations From Api
 */
function caag_hq_get_api_locations()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_location_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_locations_cron_job()
{
    $locations_system = caag_hq_get_api_locations()->fleets_locations;
    $locations_wp = caag_hq_get_locations_on_website();
    if(is_wp_error($locations_system)){
        return true;
    }
    foreach ( $locations_wp as $location ){
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_ID_META);
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_NAME_META);
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META);
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_IS_AIRPORT_META);
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_IS_OFFICE_META);
        delete_post_meta($location->ID, CAAG_HQ_RENTAL_LOCATION_ACTIVE_META);
        wp_delete_post( $location->ID );
    }
    
    foreach ( $locations_system as $location_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS . '_' . $location_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS . '_' . $location_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_ID_META, $location_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_NAME_META, $location_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META, $location_caag->brand_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_IS_AIRPORT_META, $location_caag->is_airport );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_IS_OFFICE_META, $location_caag->is_office );
        update_post_meta( $id, CAAG_HQ_RENTAL_LOCATION_ACTIVE_META, $location_caag->active );
        }
}
add_action('caag_hq_locations_update','caag_hq_locations_cron_job');

/*
 * Get Locations for display
 */
function caag_hq_get_locations_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
        'post_status'   =>  'publish',
    );
    $query = new WP_Query( $args );
    $locations = array();
    foreach ( $query->posts as $location ){
        $new_location = new stdClass();
        $new_location->id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ID_META, true );
        $new_location->name = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_NAME_META, true );
        $new_location->brand_id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META, true );
        $new_location->is_airport = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_AIRPORT_META, true );
        $new_location->is_office = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_OFFICE_META, true );
        $new_location->active = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ACTIVE_META, true );
        $locations[] = $new_location;
    }
    return $locations;
}


/*
 * Get Locations for display
 */
function caag_hq_get_active_locations_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
        'post_status'   =>  'publish',
        'meta_query'    =>  array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_LOCATION_ACTIVE_META,
                'value'     =>  '1',
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $locations = array();
    foreach ( $query->posts as $location ){
        $new_location = new stdClass();
        $new_location->id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ID_META, true );
        $new_location->name = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_NAME_META, true );
        $new_location->brand_id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META, true );
        $new_location->is_airport = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_AIRPORT_META, true );
        $new_location->is_office = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_OFFICE_META, true );
        $new_location->active = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ACTIVE_META, true );
        $locations[] = $new_location;
    }
    return $locations;
}

/*
 * Get Locations for display
 */
function caag_hq_get_active_locations_by_brand_id_for_display($caag_brand_id)
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS,
        'post_status'   =>  'publish',
        'meta_query'    =>  array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_LOCATION_ACTIVE_META,
                'value'     =>  '1',
                'compare'   =>  '='
            ),
            array(
                'key'       =>  CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $locations = array();
    foreach ( $query->posts as $location ){
        $new_location = new stdClass();
        $new_location->id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ID_META, true );
        $new_location->name = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_NAME_META, true );
        $new_location->brand_id = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_BRAND_ID_META, true );
        $new_location->is_airport = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_AIRPORT_META, true );
        $new_location->is_office = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_IS_OFFICE_META, true );
        $new_location->active = get_post_meta( $location->ID, CAAG_HQ_RENTAL_LOCATION_ACTIVE_META, true );
        $locations[] = $new_location;
    }
    return $locations;
}