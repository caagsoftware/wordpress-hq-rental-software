<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-11
 * Time: 6:35 PM
 */


/*
 * Cronjob
 */
function caag_hq_add_feature_to_vehicle_class($vehicle_class_post_id, $vehicle_class_caag_id, $caag_features)
{
    foreach ( $caag_features as $feature ){
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES,
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES . '_' . $vehicle_class_caag_id . '-' .$feature->id,
            'post_status'   =>  'publish'
        );
        $id = wp_insert_post( $args );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_ID_META, $feature->id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_POST_ID_META, $vehicle_class_post_id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_LABEL_META, $feature->label );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_LABEL_FOR_WEBSITE_META, $feature->label_for_website->en );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_ICON_META, $feature->icon );
        update_post_meta ( $id, CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_ID_META, $vehicle_class_caag_id );
    }
}

function caag_hq_delete_feature_from_vehicle_class($vehicle_class_post_id)
{
    $features = caag_hq_get_features_from_vehicle_class_post_on_website($vehicle_class_post_id);
    foreach ( $features as $feature ){
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ID_META );
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_POST_ID_META );
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_META );
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_FOR_WEBSITE_META );
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ICON_META );
        delete_post_meta ( $feature->ID, CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_ID_META );
        wp_delete_post( $feature->ID );
    }
}

/*
 * Get rates for display
 */
function caag_hq_get_features_for_display_by_post_id($post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            array(
                'key'           =>  CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_POST_ID_META,
                'value'         =>  $post_id,
                'compare'       =>  '='
            )

        )
    );
    $query = new WP_Query( $args );
    $features = array();
    foreach( $query->posts as $feature ){
        $new_feature = new stdClass();
        $new_feature->id = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ID_META, true );
        $new_feature->label = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_META, true );
        $new_feature->label_for_website = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_FOR_WEBSITE_META, true );
        $new_feature->icon = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ICON_META, true );
        $features[] = $new_feature;
    }
    return $features;
}


/*
 * Get rates for display
 */
function caag_hq_get_features_for_display_by_caag_id($caag_id)
{
    $args = array(
        'post_type'             =>  CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES,
        'post_status'           =>  'publish',
        'posts_per_page'        =>  -1,
        'meta_query'            =>  array(
            array(
                'key'               =>  CAAG_HQ_RENTAL_FEATURES_VEHICLE_CLASS_ID_META,
                'value'             =>  $caag_id,
                'compare'           =>  '='
            )
        )
    );
    $query = new WP_Query( $args );
    $features = array();
    foreach( $query->posts as $feature ){
        $new_feature = new stdClass();
        $new_feature->id = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ID_META, true );
        $new_feature->label = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_META, true );
        $new_feature->label_for_website = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_LABEL_FOR_WEBSITE_META, true );
        $new_feature->icon = get_post_meta( $feature->ID, CAAG_HQ_RENTAL_FEATURES_ICON_META, true );
        $features[] = $new_feature;
    }
    return $features;
}