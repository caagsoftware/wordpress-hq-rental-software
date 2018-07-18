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
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META);
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
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, $vehicles_classes_caag->active_rates[0]->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, $vehicles_classes_caag->active_rates[0]->season_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->base_rate,2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->hourly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->daily_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->weekly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->monthly_rate, 2) );
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
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}

/*
 * Synchonization Function
 */
function caag_hq_sync_woocommerce_products_with_vehicles_classes()
{
    if ( class_exists( 'WooCommerce' ) ) {
        $vehicles_classes = caag_hq_get_vehicle_classes_for_display();
        $args_woocommerce = array(
            'post_type'     =>  'product',
            'post_status'   =>  'publish'
        );
        $woo_product = new WP_Query( $args_woocommerce );
        foreach ( $woo_product->posts as $woocommerce_product ){
            $metas = get_post_meta( $woocommerce_product->ID );
            foreach ($metas as $meta_key => $value){
                delete_post_meta( $woocommerce_product->ID, $meta_key );
            }
            wp_delete_post( $woocommerce_product->ID );
        }
        foreach ( $vehicles_classes as $vehicle ){
            $args = array(
                'post_title' => $vehicle->label_en,
                'post_content' => $vehicle->description_en,
                'post_status' => 'publish',
                'post_type' => "product",
            );
            $post_id = wp_insert_post( $args );
            update_post_meta( $post_id, '_visibility', 'visible' );
            update_post_meta( $post_id, '_stock_status', 'instock');
            update_post_meta( $post_id, 'total_sales', '0' );
            update_post_meta( $post_id, '_downloadable', 'no' );
            update_post_meta( $post_id, '_virtual', 'yes' );
            update_post_meta( $post_id, '_regular_price', $vehicle->daily_rate );
            update_post_meta( $post_id, '_sale_price', $vehicle->daily_rate );
            update_post_meta( $post_id, '_purchase_note', '' );
            update_post_meta( $post_id, '_featured', 'no' );
            update_post_meta( $post_id, '_weight', '' );
            update_post_meta( $post_id, '_length', '' );
            update_post_meta( $post_id, '_width', '' );
            update_post_meta( $post_id, '_height', '' );
            update_post_meta( $post_id, '_sku', '' );
            update_post_meta( $post_id, '_product_attributes', array() );
            update_post_meta( $post_id, '_sale_price_dates_from', '' );
            update_post_meta( $post_id, '_sale_price_dates_to', '' );
            update_post_meta( $post_id, '_price', '' );
            update_post_meta( $post_id, '_sold_individually', '' );
            update_post_meta( $post_id, '_manage_stock', 'no' );
            update_post_meta( $post_id, '_backorders', 'no' );
            update_post_meta( $post_id, '_stock', '' );
            $attachment = array(
                'post_title' => sanitize_file_name($vehicle->label_en),
                'post_content' => '',
                'post_status' => 'publish   '
            );
            $attach_id = wp_insert_attachment( $attachment, $vehicle->image_link, $post_id );
        }
    }
}