<?php

/*
 * Scheduling the Cronjob
 */

/*
 * Location Custom Posts Metas Keys
 */
if ( ! wp_next_scheduled( 'caag_hq_additional_charges_update' ) ) {
    wp_schedule_event( time(), 'hourly', 'caag_hq_additional_charges_update' );
}

/*
 *  Get Locations From Api
 */
function caag_hq_get_api_additional_charges()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_additional_charges_endpoint();
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}

/*
 * Cronjob
 */
function caag_hq_additional_charges_cron_job()
{
    $additional_charges_system = caag_hq_get_api_additional_charges()->fleets_additional_charges;
    $additional_charges_wp = caag_hq_get_additional_charges_on_website();
    foreach ( $additional_charges_wp as $charge ){
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ID_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_NAME_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_CHARGE_TYPE_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SELECTION_TYPE_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_EN_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_NL_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_ES_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_PT_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_DE_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ICON_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_EN_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_NL_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_ES_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_PT_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_DE_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_PT_META);
        delete_post_meta($charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META);
        wp_delete_post( $charge->ID );
    }
    foreach ( $additional_charges_system as $charge_caag ) {
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES,
            'post_status'   =>  'publish',
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES . '_' . $charge_caag->id,
            'post_name'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES . '_' . $charge_caag->id,
        );
        $id = wp_insert_post( $args );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ID_META, $charge_caag->id );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_NAME_META, $charge_caag->name );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_CHARGE_TYPE_META, $charge_caag->charge_type );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SELECTION_TYPE_META, $charge_caag->selection_type );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_EN_META, $charge_caag->description->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_NL_META, $charge_caag->description->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_ES_META, $charge_caag->description->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_PT_META, $charge_caag->description->pt );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_DE_META, $charge_caag->description->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ICON_META, $charge_caag->icon );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_EN_META, $charge_caag->label_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_NL_META, $charge_caag->label_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_ES_META, $charge_caag->label_for_website->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_PT_META, $charge_caag->label_for_website->pt );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_DE_META, $charge_caag->label_for_website->de );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, $charge_caag->short_description_for_website->en );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, $charge_caag->short_description_for_website->nl );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, $charge_caag->short_description_for_website->es );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_PT_META, $charge_caag->short_description_for_website->pt );
        update_post_meta( $id, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, $charge_caag->short_description_for_website->de );
    }
}
add_action('caag_hq_additional_charges_update','caag_hq_additional_charges_cron_job');

/*
 * Get Locations for display
 */
function caag_hq_get_additional_charges_for_display()
{
    $args = array(
        'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES,
        'post_status'   =>  'publish',
    );
    $query = new WP_Query( $args );
    $charges = array();
    foreach ( $query->posts as $charge ){
        $new_charge = new stdClass();
        $new_charge->id = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ID_META, true );
        $new_charge->name = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_NAME_META, true );
        $new_charge->charge_type = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_CHARGE_TYPE_META, true );
        $new_charge->selection_type = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SELECTION_TYPE_META, true );
        $new_charge->description_en = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_EN_META, true );
        $new_charge->description_nl = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_NL_META, true );
        $new_charge->description_es = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_ES_META, true );
        $new_charge->description_pt = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_PT_META, true );
        $new_charge->description_de = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_DESCRIPTION_DE_META, true );
        $new_charge->icon = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_ICON_META, true );
        $new_charge->label_en = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_EN_META, true );
        $new_charge->label_nl = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_NL_META, true );
        $new_charge->label_es = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_ES_META, true );
        $new_charge->label_pt = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_PT_META, true );
        $new_charge->label_de = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_LABEL_FOR_WEBSITE_DE_META, true );
        $new_charge->short_description_en = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_charge->short_description_nl = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_charge->short_description_es = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_ES_META, true );
        $new_charge->short_description_pt = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_PT_META, true );
        $new_charge->short_description_de = get_post_meta( $charge->ID, CAAG_HQ_RENTAL_ADDITIONAL_CHARGES_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $charges[] = $new_charge;
    }
    return $charges;
}