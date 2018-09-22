<?php

/*
 * Scheduling the Cronjob
 */

/*
 * Location Custom Posts Metas Keys
 */
if ( ! wp_next_scheduled( 'caag_hq_brands_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_brands_update' );
}

/*
 *  Get Locations From Api
 */
function caag_hq_get_api_brands()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_brands_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_brands_cron_job()
{
    $brands_system = caag_hq_get_api_brands()->fleets_brands;
    $brands_wp = caag_hq_get_brands_on_website();
    if(is_wp_error($brands_system)){
        return true;
    }
    foreach ( $brands_wp as $brand ){
        delete_post_meta( $brand->ID , CAAG_HQ_RENTAL_BRAND_ID_META);
        delete_post_meta( $brand->ID , CAAG_HQ_RENTAL_BRAND_NAME_META);
        delete_post_meta( $brand->ID , CAAG_HQ_RENTAL_BRAND_TAX_LABEL_META);
        delete_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_TAX_AMOUNT_META );
        delete_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_WEBSITE_LINK );
        wp_delete_post( $brand->ID );
    }
    foreach ( $brands_system as $brand_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS . '_' . $brand_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS . '_' . $brand_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_BRAND_ID_META, $brand_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_BRAND_NAME_META, $brand_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_BRAND_TAX_LABEL_META, $brand_caag->tax_label );
        update_post_meta( $id, CAAG_HQ_RENTAL_BRAND_TAX_AMOUNT_META, $brand_caag->abb_tax );
        update_post_meta( $id, CAAG_HQ_RENTAL_BRAND_WEBSITE_LINK, $brand_caag->website_link );
    }
}
add_action('caag_hq_brands_update','caag_hq_brands_cron_job');

/*
 * Get Locations for display
 */
function caag_hq_get_brands_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS,
        'post_status'   =>  'publish',
        'posts_per_page' =>  -1,
    );
    $query = new WP_Query( $args );
    $brands = array();
    foreach ( $query->posts as $brand ){
        $new_brand = new stdClass();
        $new_brand->id = get_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_ID_META, true );
        $new_brand->name = get_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_NAME_META, true );
        $new_brand->tax = get_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_TAX_LABEL_META, true );
        $new_brand->tax_amount = get_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_TAX_AMOUNT_META, true );
        $new_brand->page_link = get_post_meta( $brand->ID, CAAG_HQ_RENTAL_BRAND_WEBSITE_LINK, true );
        $brands[] = $new_brand;
    }
    return $brands;
}
