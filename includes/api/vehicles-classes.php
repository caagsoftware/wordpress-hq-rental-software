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
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META);
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
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, $vehicles_classes_caag->label_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, $vehicles_classes_caag->label_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->short_description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, $vehicles_classes_caag->short_description_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, $vehicles_classes_caag->short_description_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, $vehicles_classes_caag->description_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, $vehicles_classes_caag->description_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, $vehicles_classes_caag->images[0]->public_link );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, $vehicles_classes_caag->images[0]->extension );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, $vehicles_classes_caag->active_rates[0]->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, $vehicles_classes_caag->active_rates[0]->season_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->base_rate,2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->hourly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->daily_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->weekly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->monthly_rate, 2) );
    }
    caag_hq_sync_woocommerce_products_with_vehicles_classes();
}
add_action('caag_hq_vehicle_classes_update','caag_hq_vehicle_classes_cron_job');

/*
 * Get rates for display
 */
function caag_hq_get_vehicle_classes_for_display()
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1
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
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
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
        $woo_products = new WP_Query( $args_woocommerce );
        foreach ( $woo_products->posts as $woocommerce_product ){
            $attachment_id = get_post_thumbnail_id( $woocommerce_product->ID );
            $metas = get_post_meta( $woocommerce_product->ID );
            foreach ($metas as $meta_key => $value){
                delete_post_meta( $woocommerce_product->ID, $meta_key );
            }
            wp_delete_attachment( $attachment_id );
            wp_delete_post( $woocommerce_product->ID, true );
        }
        foreach ( $vehicles_classes as $vehicle ){
            $args = array(
                'post_title' => $vehicle->label_en,
                'post_content' => $vehicle->description_en,
                'post_status' => 'publish',
                'post_type' => 'product',
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
            update_post_meta( $post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, $vehicle->id );
            if($vehicle->image_link){
                caag_hq_download_and_set_post_image($vehicle->image_link, $post_id, $vehicle->label_en . $vehicle->id . $post_id, $vehicle->image_link_extension);
            }
        }
    }
}

function caag_hq_download_and_set_post_image( $url, $post_id, $file_name, $file_extension )
{
    if( !class_exists( 'WP_Http' ) ){
        include_once( ABSPATH . WPINC . '/class-http.php' );
    }
    $http = new WP_Http();
    $response = $http->request( $url );
    if( is_wp_error($response) ){
        return false;
    }
    if( $response['response']['code'] != 200 ) {
        return false;
    }
    $upload = wp_upload_bits( basename(str_replace(' ', '', $file_name . '.' . $file_extension)), null, $response['body'] );
    if( !empty( $upload['error'] ) ) {
        return false;
    }

    $file_path = $upload['file'];
    $file_name = basename( $file_path );
    $file_type = wp_check_filetype( $file_name, null );
    $attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
    $wp_upload_dir = wp_upload_dir();

    $post_info = array(
        'guid'				=> $wp_upload_dir['url'] . '/' . $file_name,
        'post_mime_type'	=> $file_type['type'],
        'post_title'		=> $attachment_title,
        'post_content'		=> '',
        'post_status'		=> 'inherit',
    );

    // Create the attachment
    $attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );

    // Include image.php
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Define attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

    // Assign metadata to attachment
    wp_update_attachment_metadata( $attach_id,  $attach_data );
    set_post_thumbnail( $post_id, $attach_id );
}

function caag_hq_get_post_attachment_id( $post_id )
{
    return get_post_meta( $post_id, '_thumbnail_id', true );
}


function caag_hq_get_vehicle_classes_for_display_by_caag_id( $caag_vehicle_class_id )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META,
                'value'     =>  $caag_vehicle_class_id,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $new_vehicle = new stdClass();;
    foreach( $query->posts as $vehicle ){
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
    }
    return $new_vehicle;
}
