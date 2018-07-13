<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-11
 * Time: 6:35 PM
 */

/*
 * Scheduling the Cronjob
 */

if ( ! wp_next_scheduled( 'caag_hq_vehicle_classes_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_vehicle_classes_update' );
}

/*
 *  Get rates From Api
 */
function caag_hq_get_api_vehicle_classes()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_vehicle_classes_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_vehicle_classes_cron_job()
{
    $vehicle_classes_system = caag_hq_get_api_vehicle_classes()->fleets_vehicle_classes;
    $vehicle_classes_wp = caag_hq_get_vehicle_classes_on_website();
    foreach ( $vehicle_classes_wp as $vehicle ){
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META);
        wp_delete_post( $vehicle->ID );
    }
    foreach ( $vehicle_classes_system as $vehicles_classes_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES . '_' . $vehicles_classes_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES . '_' . $vehicles_classes_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, $vehicles_classes_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, $vehicles_classes_caag->brand_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, $vehicles_classes_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, $vehicles_classes_caag->label_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->short_description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, $vehicles_classes_caag->public_image_link );
    }
}
add_action('caag_hq_vehicle_classes_update','caag_hq_vehicle_classes_cron_job');

/*
 * Get rates for display
 */
function caag_hq_get_vehicle_classes_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'   =>  'publish',
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}


