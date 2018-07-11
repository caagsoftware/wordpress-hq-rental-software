<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-10
 * Time: 9:34 PM
 */

function register_caag_hq_rental_custom_post_vehicle_classes()
{
    $args = array(
        'public'                    => false,
        'publicly_queryable'        => true,
        'show_ui'                   => false,
        'show_in_menu'              => false,
        'show_in_nav_menus'         => false,
        'query_var'                 => false,
        'rewrite'                   => array( 'slug' => CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES ),
        'capability_type'           => 'post',
        'has_archive'               => false,
        'hierarchical'              => false,
        'supports'                  => array('title'),
        'capabilities'              => array(
        'create_posts'              => 'do_not_allow',
        )
    );
        register_post_type(CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES, $args);
}

/*
 * Hook the registration function
 */
add_action( 'init', 'register_caag_hq_rental_custom_post_vehicle_classes' );
