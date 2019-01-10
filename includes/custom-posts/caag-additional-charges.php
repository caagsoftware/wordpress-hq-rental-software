<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-10
 * Time: 9:34 PM
 */

function register_caag_hq_rental_custom_post_additional_charges()
{
    $args = array(
        'public'                    => false,
        'publicly_queryable'        => false,
        'show_ui'                   => false,
        'show_in_menu'              => false,
        'show_in_nav_menus'         => false,
        'query_var'                 => false,
        'rewrite'                   => array( 'slug' => CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES ),
        'capability_type'           => 'post',
        'has_archive'               => false,
        'hierarchical'              => false,
        'supports'                  => array('title'),
        'has_archive'               => false,
        'capabilities'              => array(
            'create_posts'              => 'do_not_allow',
        )
    );
    register_post_type(CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES, $args);
}

/*
 * Hook the registration function
 */
add_action( 'init', 'register_caag_hq_rental_custom_post_additional_charges' );
