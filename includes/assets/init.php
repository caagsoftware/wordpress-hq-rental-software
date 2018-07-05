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
    wp_register_script('caag-rental-iframe-resize',
        plugin_dir_url(__FILE__) . 'js/iframeSizer.min.js?version=3.5.15');
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