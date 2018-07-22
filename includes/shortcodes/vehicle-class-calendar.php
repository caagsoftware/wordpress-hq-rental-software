<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-18
 * Time: 4:58 PM
 */



/*
 * HQ Rental Calendar Shortcode
 * @args array : caag_form_id
 * @return string: html code
 */
function caag_hq_rental_calendar_form($atts = [])
{
    if( isset( $atts['id'] ) ){
        caag_hq_rental_styles();
        caag_hq_rental_scripts();
        $caag_id = $atts['id'];
        $link = caag_hq_rental_get_calendar_link($atts['id']);
        $get_data = $_GET;
        if(!empty($get_data['vehicle_class_id'])){
            $link .= '&vehicle_class_id=' . $get_data['vehicle_class_id'];
        }elseif( isset( $atts['vehicle_class_id'] ) ){
            $link .= '&vehicle_class_id=' . $atts['vehicle_class_id'];
        }

        if( isset( $atts['forced_locale'] ) ){
            $lang = '&forced_locale=' . $atts['forced_locale'];
        }else{
            $lang = '';
        }
        return '<iframe id="caag-rental-iframe" src="' . $link . $lang . '" scrolling="no"></iframe>';
    }
}
add_shortcode('hq_rental_forms_calendar', 'caag_hq_rental_calendar_form');