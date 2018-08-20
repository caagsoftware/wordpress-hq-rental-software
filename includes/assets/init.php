<?php


/*
 * Register and Enqueue Caag Rental Styles
 * @return void
 */
function caag_hq_rental_styles()
{
    wp_register_style('caag-rental', plugin_dir_url(__FILE__) . 'css/caag_hq_rental.css?version=1.0.12');
    wp_enqueue_style('caag-rental');
}
add_action('caag_hq_rental_styles', 'caag_hq_rental_styles');

/*
 * Load Script Files
 * return void
 */
function caag_hq_rental_scripts()
{
    //Registration

    wp_register_script('caag-rental-iframe-resize', plugin_dir_url(__FILE__) . 'js/iframeSizer.min.js?version=3.5.15');
    wp_register_script('caag-rental-iframe-init', plugin_dir_url(__FILE__) . 'js/caagResize.js?version=1.0.1', array('jquery'));
    //Enqueue
    wp_enqueue_script('caag-rental-iframe-resize');
    wp_enqueue_script('caag-rental-iframe-init');
}
add_action('wp_enqueue_script', 'caag_hq_rental_scripts');

/*
 * Loading Inline Js Submit Script
 * return void
*/
function caag_hq_rental_inline_script()
{
    wp_enqueue_script('caag-rental-script-submit', plugin_dir_url(__FILE__) . 'js/submit.js?timestamp=' . time(),
        ['jquery']);
}
add_action('wp_enqueue_script', 'caag_hq_rental_inline_script');

/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function caag_hq_rental_get_times( $begining, $end, $default = '12:00', $interval = '+15 minutes' ) {

    $output = '';

    $current = strtotime( $begining );
    $end = strtotime( $end   );

    while( $current <= $end ) {
        $time = date( 'H:i', $current );
        $sel = ( $time == $default ) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h:i A', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}

function caag_hq_rental_global_variables_to_js()
{
    wp_register_script('hq_dummy_asset', plugin_dir_url(__FILE__) . 'js/hq-dummy.js');
    wp_enqueue_script('hq_dummy_asset');
    wp_localize_script('hq_dummy_asset', 'hq_plugin_global_date_format', get_option(CAAG_HQ_RENTAL_DATE_FORMAT, 'Y-m-d H:i'));
}
add_action( 'wp_enqueue_scripts', 'caag_hq_rental_global_variables_to_js', 12);


/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function caag_hq_rental_get_times_military( $begining, $end, $default = '12:00', $interval = '+15 minutes' ) {

    $output = '';

    $current = strtotime( $begining );
    $end = strtotime( $end   );

    while( $current <= $end ) {
        $time = date( 'H:i', $current );
        $sel = ( $time == $default ) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date( 'H:i', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}
