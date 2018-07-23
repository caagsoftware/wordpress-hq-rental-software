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
function caag_hq_add_vehicle_class_images($vehicle_class_post_id, $vehicle_class_caag_id, $caag_images)
{
    foreach ( $caag_images as $image ){
        $args = array(
            'post_type'     =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES,
            'post_title'    =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES . '_' . $image->id,
            'post_status'   =>  'publish'
        );
        $id = wp_insert_post( $args );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META, $image->id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META, $image->id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_EXTENSION_META, $image->extension );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_MIME_META, $image->mime );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META, $image->public_link );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META, $vehicle_class_caag_id );
        update_post_meta ( $id, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META, $vehicle_class_post_id );
    }
}

function caag_hq_delete_vehicle_class_image($vehicle_class_post_id)
{
    $images = caag_hq_get_vehicles_images_from_vehicle_class_post_on_website($vehicle_class_post_id);
    foreach ( $images as $image ){
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_FILENAME_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_EXTENSION_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_MIME_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_CAAG_CLASS_ID_META );
        delete_post_meta ( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META );
        wp_delete_post( $image->ID );
    }
}

/*
 * Get rates for display
 */
function caag_hq_get_vehicle_image_for_display($caag_vehicle_class_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_CAAG_CLASS_ID_META,
            'value'             =>  $caag_vehicle_class_id,
            'compare'           =>  '=',
            'posts_per_page'    =>  -1,
        )
    );
    $query = new WP_Query( $args );
    $images = array();
    foreach( $query->posts as $image ){
        $new_image = new stdClass();
        $new_image->id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META, true );
        $new_image->filename = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_FILENAME_META, true );
        $new_image->extension = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_EXTENSION_META, true );
        $new_image->mime = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_MIME_META, true );
        $new_image->link = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META, true );
        $new_image->caag_class_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_CAAG_CLASS_ID_META, true );
        $new_image->image_post_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META, true );
        $images[] = $new_image;
    }
    return $images;
}
/*
 * Get rates for display
 */
function caag_hq_get_vehicle_image_for_display_by_vehicle_post_id($class_image_custom_post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META,
            'value'             =>  $class_image_custom_post_id,
            'compare'           =>  '=',
            'posts_per_page'    =>  -1,
        )
    );
    $query = new WP_Query( $args );
    $images = array();
    foreach( $query->posts as $image ){
        $new_image = new stdClass();
        $new_image->id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META, true );
        $new_image->filename = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_FILENAME_META, true );
        $new_image->extension = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_EXTENSION_META, true );
        $new_image->mime = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_MIME_META, true );
        $new_image->link = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META, true );
        $new_image->caag_class_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_CAAG_CLASS_ID_META, true );
        $new_image->image_post_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META, true );
        $images[] = $new_image;
    }
    return $images;
}
function caag_hq_get_vehicles_images_from_vehicle_class_post_on_website($vehicle_class_post_id)
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            'key'               =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META,
            'value'             =>  $vehicle_class_post_id,
            'compare'           =>  '=',
            'posts_per_page'    =>  -1,
        )
    );
    $query = new WP_Query( $args );
    $images = array();
    foreach( $query->posts as $image ){
        $new_image = new stdClass();
        $new_image->id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_ID_META, true );
        $new_image->filename = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_FILENAME_META, true );
        $new_image->extension = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_EXTENSION_META, true );
        $new_image->mime = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_MIME_META, true );
        $new_image->link = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_PUBLIC_LINK_META, true );
        $new_image->caag_class_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_CAAG_CLASS_ID_META, true );
        $new_image->image_post_id = get_post_meta( $image->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGES_VEHICLE_CLASS_CUSTOM_POST_ID_META, true );
        $images[] = $new_image;
    }
    return $images;
}