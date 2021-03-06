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
    if( is_wp_error( $response ) ){
        return true;
    }else{
        return json_decode($response['body']);
    }
}

/*
 * Cronjob
 */
function caag_hq_vehicle_classes_cron_job()
{
    $vehicle_classes_system = caag_hq_get_api_vehicle_classes()->fleets_vehicle_classes;
    $vehicle_classes_wp = caag_hq_get_vehicle_classes_on_website();
    if(is_wp_error($vehicle_classes_system)){
        return true;
    }
    foreach ( $vehicle_classes_wp as $vehicle ){
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META);
        delete_post_meta($vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META);

        caag_hq_delete_feature_from_vehicle_class( $vehicle->ID );

        caag_hq_delete_vehicle_class_image( $vehicle->ID );
        caag_hq_delete_decreasing_rate_from_custom_post_vehicle_class( $vehicle->ID );
        wp_delete_post( $vehicle->ID, true );
    }
    foreach ( $vehicle_classes_system as $vehicles_classes_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
            'post_status'   =>  'publish',
            'post_title'    =>  $vehicles_classes_caag->name,
        );
        $id = wp_insert_post( $args );
        caag_hq_add_feature_to_vehicle_class( $id, $vehicles_classes_caag->id, $vehicles_classes_caag->features );
        caag_hq_add_decreasing_rate_to_vehicle_class( $id, $vehicles_classes_caag->id, $vehicles_classes_caag->active_rates[0]->price_intervals );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, $vehicles_classes_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, $vehicles_classes_caag->brand_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, $vehicles_classes_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, $vehicles_classes_caag->active );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, $vehicles_classes_caag->recommended );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, $vehicles_classes_caag->label_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, $vehicles_classes_caag->label_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, $vehicles_classes_caag->label_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, $vehicles_classes_caag->label_for_website->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->short_description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, $vehicles_classes_caag->short_description_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, $vehicles_classes_caag->short_description_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, $vehicles_classes_caag->short_description_for_website->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, $vehicles_classes_caag->description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, $vehicles_classes_caag->description_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, $vehicles_classes_caag->description_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, $vehicles_classes_caag->description_for_website->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, $vehicles_classes_caag->images[0]->public_link );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, $vehicles_classes_caag->images[0]->extension );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, $vehicles_classes_caag->active_rates[0]->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, $vehicles_classes_caag->active_rates[0]->season_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->base_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->hourly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->daily_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->weekly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, number_format((float)$vehicles_classes_caag->active_rates[0]->monthly_rate, 2) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, caag_hq_set_prices_with_taxes( $vehicles_classes_caag->active_rates[0]->base_rate, $vehicles_classes_caag->brand->abb_tax ) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, caag_hq_set_prices_with_taxes( $vehicles_classes_caag->active_rates[0]->hourly_rate, $vehicles_classes_caag->brand->abb_tax ) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, caag_hq_set_prices_with_taxes( $vehicles_classes_caag->active_rates[0]->daily_rate, $vehicles_classes_caag->brand->abb_tax ) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, caag_hq_set_prices_with_taxes( $vehicles_classes_caag->active_rates[0]->weekly_rate, $vehicles_classes_caag->brand->abb_tax ) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, caag_hq_set_prices_with_taxes( $vehicles_classes_caag->active_rates[0]->monthly_rate, $vehicles_classes_caag->brand->abb_tax ) );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, $vehicles_classes_caag->f214 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, $vehicles_classes_caag->f215 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, $vehicles_classes_caag->f216 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, $vehicles_classes_caag->f217 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, $vehicles_classes_caag->f218 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, $vehicles_classes_caag->f219 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, $vehicles_classes_caag->f220 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, $vehicles_classes_caag->f221 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, $vehicles_classes_caag->f222 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, $vehicles_classes_caag->f223 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, $vehicles_classes_caag->f224 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, $vehicles_classes_caag->f225 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, $vehicles_classes_caag->f226 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, $vehicles_classes_caag->f227 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, $vehicles_classes_caag->f228 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, $vehicles_classes_caag->f229 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, $vehicles_classes_caag->f230 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, $vehicles_classes_caag->f231 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, $vehicles_classes_caag->f232 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, $vehicles_classes_caag->f233 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, $vehicles_classes_caag->f234 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, $vehicles_classes_caag->f235 );
        update_post_meta( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, $vehicles_classes_caag->active_rates[0]->decreasing_rates_based_on_intervals );
        if( !empty( $vehicles_classes_caag->images ) ){
            foreach ( $vehicles_classes_caag->images as $image) {
                caag_hq_add_vehicle_class_images( $id, $vehicles_classes_caag->id, $image );
            }
        }
    }
    if(get_option(CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION, false) == "1"){
        caag_hq_sync_woocommerce_products_with_vehicles_classes();
    }

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
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
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
            'post_status'   =>  'publish',
            'posts_per_page'    =>  -1
        );
        $woo_products = new WP_Query( $args_woocommerce );
        foreach ( $woo_products->posts as $woocommerce_product ){
            $woo_helper = new WC_Product_Factory();
            $product = $woo_helper->get_product( $woocommerce_product->ID );
            $gallery_ids = $product->get_gallery_image_ids();
            foreach ($gallery_ids as $attached_id){
                $deleted_attachment = wp_delete_attachment( $attached_id );
            }
            if(has_post_thumbnail( $woocommerce_product->ID )){
                $attachment_id = get_post_thumbnail_id( $woocommerce_product->ID );
            }
            $metas = get_post_meta( $woocommerce_product->ID );
            foreach ($metas as $meta_key => $value){
                delete_post_meta( $woocommerce_product->ID, $meta_key );
            }
            $deleted_attachment = wp_delete_attachment( $attachment_id );
            $deleted_product = wp_delete_post( $woocommerce_product->ID, true );
        }
        foreach ( $vehicles_classes as $vehicle ){
            $title = ! empty( $vehicle->name ) ? $vehicle->name : $vehicle->label_de;
            $description = ! empty( $vehicle->description_en ) ? $vehicle->description_en : $vehicle->description_de;
            $args = array(
                'post_title'    => $title,
                'post_content'  => $description,
                'post_status'   => 'publish',
                'post_type'     => 'product'
            );
            $post_id = wp_insert_post( $args );
            if($vehicle->decreasing_rate_based_on_intervals){
                $rate = caag_hq_get_lower_decreasing_rates_for_display_by_caag_id( $vehicle->id );
            }else if(get_option(CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC) == "1"){
                $rate = $vehicle->daily_rate_plus_tax;
            }else{
                $rate = $vehicle->daily_rate;
            }
            update_post_meta( $post_id, '_visibility', 'visible' );
            update_post_meta( $post_id, '_stock_status', 'instock');
            update_post_meta( $post_id, 'total_sales', '0' );
            update_post_meta( $post_id, '_downloadable', 'no' );
            update_post_meta( $post_id, '_virtual', 'yes' );
            update_post_meta( $post_id, '_regular_price', str_replace(",", "", $rate));
            update_post_meta( $post_id, '_sale_price', str_replace(",", "", $rate) );
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
            update_post_meta( $post_id, '_price', str_replace(",", "", $rate) );
            update_post_meta( $post_id, '_sold_individually', '' );
            update_post_meta( $post_id, '_manage_stock', 'no' );
            update_post_meta( $post_id, '_backorders', 'no' );
            update_post_meta( $post_id, '_stock', 10 );
            update_post_meta( $post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, $vehicle->id );
            update_post_meta( $post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_BRAND_ID_ON_WOOCOMMERCE_PRODUCT_META, $vehicle->brand_id );
            update_post_meta( $post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, $vehicle->active  );
            $images = caag_hq_get_vehicles_images_from_vehicle_class_post_on_website( $vehicle->post_id );
            if(!empty($images)){
                foreach ($images as $image){
                    caag_hq_download_and_set_post_image($image->link, $post_id, $title . $image->id . $post_id, $image->extension, true);
                }
            }
        }
    }
}


/*
 * Download and Set Products Thumnbnail
 */
function caag_hq_download_and_set_post_image( $url, $post_id, $file_name, $file_extension, $gallery)
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

    /*
     * Attachments
     */
    $post_info = array(
        'guid'				=> $wp_upload_dir['url'] . '/' . $file_name,
        'post_mime_type'	=> $file_type['type'],
        'post_title'		=> $attachment_title,
        'post_content'		=> '',
        'post_status'		=> 'inherit',
    );
    if($gallery){
        // Create the attachment
        $attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );
        $woo_helper = new WC_Product_Factory();
        $product = $woo_helper->get_product( $post_id );
        $product->set_gallery_image_ids( array_merge( $product->get_gallery_image_ids(), array( $attach_id )) );
        $product->save();

        // Include image.php
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id,  $attach_data );
        return set_post_thumbnail( $post_id, $attach_id );
    }else{
        // Create the attachment
        $attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );

        // Include image.php
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id,  $attach_data );
        return set_post_thumbnail( $post_id, $attach_id );
    }
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
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles[0];
}


function caag_hq_get_vehicle_class_caag_id_from_product_post( $product_id )
{
    return get_post_meta($product_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, true);
}

function caag_hq_get_vehicle_classes_for_display_by_brand_id( $caag_brand_id )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}

function caag_hq_get_vehicle_classes_for_display_by_brand_id_and_custom_field( $caag_brand_id = 1, $custom_field, $value )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            ),
            array(
                'key'       =>  'caag_hq_rental_vehicle_class_custom_field_'. $custom_field .'_meta',
                'value'     =>  $value,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}


/**
 * Filter By Brand id and Custom Field
 */
function caag_hq_get_vehicle_classes_by_brand_id_and_custom_field_for_display( $caag_brand_id, $custom_field )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            ),
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META,
                'value'     =>  $custom_field,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}
/**
 * Filter By Brand id and Custom Field
 */
function caag_hq_get_vehicle_classes_by_brand_id_and_custom_field_meta_for_display( $caag_brand_id, $custom_field_meta,  $custom_field_value )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            ),
            array(
                'key'       =>  $custom_field_meta,
                'value'     =>  $custom_field_value,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}


function caag_hq_get_all_makes_by_brands( $caag_brand_id )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
                'value'     =>  $caag_brand_id,
                'compare'   =>  '='
            ),
            array(
                'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META,
                'value'     =>  $custom_field,
                'compare'   =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->label_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_ES_META, true );
        $new_vehicle->short_description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->description_es = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate =     get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->tech_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f214 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f222 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->f223 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F223_META, true );
        $new_vehicle->f224 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F224_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->f226 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->f227 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->f228 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F228_META, true );
        $new_vehicle->f229 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F229_META, true );
        $new_vehicle->f230 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F230_META, true );
        $new_vehicle->f231 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F231_META, true );
        $new_vehicle->f232 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F232_META, true );
        $new_vehicle->f233 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F233_META, true );
        $new_vehicle->f234 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F234_META, true );
        $new_vehicle->f235 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        $vehicles[] = $new_vehicle;
    }
    return $vehicles;
}
