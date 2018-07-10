<?php

/*
 * Scheduling the Cronjob
 */

if ( ! wp_next_scheduled( 'caag_hq_rates_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_rates_update' );
}

/*
 *  Get rates From Api
 */
function caag_hq_get_api_rates()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_rates_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_rates_cron_job()
{
    $rates_system = caag_hq_get_api_rates();
    $rates_wp = caag_hq_get_rates_on_website();
    foreach ( $rates_wp as $rate ){
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_ID_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_SEASON_ID_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_VEHICLE_CLASS_ID_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_BASE_RATE_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_HOURLY_RATE_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_DAILY_RATE_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_WEEKLY_RATE_META);
        delete_post_meta($rate->ID, CAAG_HQ_RENTAL_RATE_MONTHLY_RATE_META);
        wp_delete_post( $rate->ID );
    }
    foreach ( $rates_system as $rate_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_RATES,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_RATES . '_' . $rate_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_RATES . '_' . $rate_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_ID_META, $rate_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_SEASON_ID_META, $rate_caag->season_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_VEHICLE_CLASS_ID_META, $rate_caag->vehicle_class_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_BASE_RATE_META, $rate_caag->base_rate );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_HOURLY_RATE_META, $rate_caag->hourly_rate );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_DAILY_RATE_META, $rate_caag->daily_rate );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_WEEKLY_RATE_META, $rate_caag->weekly_rate );
        update_post_meta( $id, CAAG_HQ_RENTAL_RATE_MONTHLY_RATE_META, $rate_caag->monthly_rate );
    }
}
add_action('caag_hq_rates_update','caag_hq_rates_cron_job');

/*
 * Get rates for display
 */
function caag_hq_get_rates_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_RATES,
        'post_status'   =>  'publish',
    );
    $query = new WP_Query( $args );
    $rates = array();
    foreach( $query->posts as $rate ){
        $new_rate = new stdClass();
        $new_rate->id = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_ID_META, true );
        $new_rate->name = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_SEASON_ID_META, true );
        $new_rate->brand_id = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_VEHICLE_CLASS_ID_META, true );
        $new_rate->is_airport = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_BASE_RATE_META, true );
        $new_rate->is_office = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_DAILY_RATE_META, true );
        $new_rate->active = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_WEEKLY_RATE_META, true );
        $new_rate->active = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_RATE_MONTHLY_RATE_META, true );
        $rates[] = $new_rate;
    }
    return $rates;
}
