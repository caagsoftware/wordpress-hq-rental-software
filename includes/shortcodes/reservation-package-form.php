<?php

/*
 * HQ Rental Package Form Shortcode
 * @args array : caag_form_id
 * @return string: html code
 */
function caag_hq_rental_forms_reservation_packages($atts = [])
{
	caag_hq_rental_styles();
	caag_hq_rental_scripts();
	$caag_id = $atts['id'];
    if(isset( $atts['forced_locale'] )){
        $lang = '&forced_locale=' . $atts['forced_locale'];
    }else{
        $lang = '';
    }
	$link = get_caag_hq_rental_reservation_package_link($caag_id) . $lang;
	return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
}
add_shortcode('hq_rental_forms_reservation_packages', 'caag_hq_rental_forms_reservation_packages');