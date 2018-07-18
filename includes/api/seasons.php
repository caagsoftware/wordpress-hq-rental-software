<?php

/*
 * Scheduling the Cronjob
 */

if ( ! wp_next_scheduled( 'caag_hq_seasons_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_seasons_update' );
}

/*
 *  Get rates From Api
 */
function caag_hq_get_api_seasons()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_seasons_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_seasons_cron_job()
{
    $seasons_system = caag_hq_get_api_seasons();
    $seasons_wp = caag_hq_get_seasons_on_website();
    foreach ( $seasons_wp as $season ){
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_ID_META);
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_BRAND_ID_META);
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_NAME_META);
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_DATE_START_META);
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_DATE_END_META);
        delete_post_meta($season->ID, CAAG_HQ_RENTAL_SEASON_MINIMAL_RENTAL_PERIOD_META);
        wp_delete_post( $season->ID );
    }
    foreach ( $seasons_system as $season_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS . '_' . $season_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS . '_' . $season_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_ID_META, $season_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_BRAND_ID_META, $season_caag->brand_id );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_NAME_META, $season_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_DATE_START_META, $season_caag->date_start );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_DATE_END_META, $season_caag->date_end );
        update_post_meta( $id, CAAG_HQ_RENTAL_SEASON_MINIMAL_RENTAL_PERIOD_META, $season_caag->minimal_rental_period );
    }
}
add_action('caag_hq_seasons_update','caag_hq_seasons_cron_job');

/*
 * Get rates for display
 */
function caag_hq_get_seasons_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS,
        'post_status'   =>  'publish',
    );
    $query = new WP_Query( $args );
    $seasons = array();
    foreach( $query->posts as $season ){
        $new_season = new stdClass();
        $new_season->id = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_ID_META, true );
        $new_season->brand_id = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_BRAND_ID_META, true );
        $new_season->name = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_NAME_META, true );
        $new_season->date_start = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_DATE_START_META, true );
        $new_season->date_end = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_DATE_END_META, true );
        $new_season->minimal_rental_period = get_post_meta( $season->ID, CAAG_HQ_RENTAL_SEASON_MINIMAL_RENTAL_PERIOD_META, true );
        $seasons[] = $new_season;
    }
    return $seasons;
}