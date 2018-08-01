<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-11
 * Time: 6:35 PM
 */


function caag_hq_add_decreasing_rate_to_vehicle_class($vehicle_class_post_id, $vehicle_class_caag_id, $rates)
{
    if(empty($rates)){
        return true;
    }
    foreach ($rates as $rate){
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_DECREASING_RATES,
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_DECREASING_RATES . '_' . $vehicle_class_caag_id . '-' .$vehicle_class_post_id,
            'post_status'   =>  'publish'
        );
        $id = wp_insert_post( $args );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_ORDER_META, $rate->order );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_PRICE_META, number_format((float)$rate->price,2) );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_START_INTERVAL_META, $rate->start_interval );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_END_INTERVAL_META, $rate->end_interval );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CAAG_ID_META, $vehicle_class_caag_id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CUSTOM_POST_ID_META, $vehicle_class_post_id );
    }

}

function caag_hq_delete_decreasing_rate_from_custom_post_vehicle_class($vehicle_class_post_id)
{
    $rates = caag_hq_get_decreasing_rates_for_display_by_vehicle_class_post_id($vehicle_class_post_id);
    foreach ( $rates as $rate ){
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_ORDER_META );
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_PRICE_META );
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_START_INTERVAL_META );
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_END_INTERVAL_META );
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CAAG_ID_META );
        delete_post_meta ( $rate->post_id, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CUSTOM_POST_ID_META );
        wp_delete_post( $rate->post_id );
    }
}

/*
 * Get rates for display
 */
function caag_hq_get_decreasing_rates_for_display_by_vehicle_class_post_id($post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_DECREASING_RATES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            array(
                'key'           =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CUSTOM_POST_ID_META,
                'value'         =>  $post_id,
                'compare'       =>  '='
            )

        )
    );
    $query = new WP_Query( $args );
    $rates = array();
    foreach( $query->posts as $rate ){
        $new_rate = new stdClass();
        $new_rate->order = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_ORDER_META, true );
        $new_rate->price = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_PRICE_META, true );
        $new_rate->start_interval = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_START_INTERVAL_META, true );
        $new_rate->end_interval = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_END_INTERVAL_META, true );
        $new_rate->post_id = $rate->ID;
        $new_rate->caag_vehicle_class_id = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CAAG_ID_META, true );
        $rates[] = $new_rate;
    }
    return $rates;
}


/*
 * Get rates for display
 */
function caag_hq_get_decreasing_rates_for_display_by_caag_id($caag_id)
{
    $args = array(
        'post_type'             =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_DECREASING_RATES,
        'post_status'           =>  'publish',
        'posts_per_page'        =>  -1,
        'meta_query'            =>  array(
            array(
                'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CAAG_ID_META,
                'value'             =>  $caag_id,
                'compare'           =>  '=',
                'posts_per_page'    =>  -1,
            )
        )
    );
    $query = new WP_Query( $args );
    $rates = array();
    foreach( $query->posts as $rate ){
        $new_rate = new stdClass();
        $new_rate->order = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_ORDER_META, true );
        $new_rate->price = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_PRICE_META, true );
        $new_rate->start_interval = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_START_INTERVAL_META, true );
        $new_rate->end_interval = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_END_INTERVAL_META, true );
        $new_rate->post_id = $rate->ID;
        $new_rate->caag_vehicle_class_id = get_post_meta( $rate->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DECREASING_RATE_VEHICLE_CLASS_CAAG_ID_META, true );
        $rates[] = $new_rate;
    }
    return $rates;
}

function caag_hq_order_classes_by_price($a, $b)
{
    return strnatcmp($a->name, $b->name);
}

function caag_hq_get_lower_decreasing_rates_for_display_by_caag_id($caag_id)
{
    $rates = caag_hq_get_decreasing_rates_for_display_by_caag_id($caag_id);
    usort($rates, "caag_hq_order_classes_by_price");
    return str_replace(",", "", $rates[count($rates) -  1]->price);
}



