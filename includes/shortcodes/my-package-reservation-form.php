<?php

/*
 * HQ Rental My Package Reservation Form Shortcode
 * @args array : caag_form_id
 * @return string: html code
 */
function caag_hq_rental_forms_my_package_reservation($atts = [])
{
	caag_hq_rental_styles();
	caag_hq_rental_scripts();
	$caag_id = $atts['id'];
    if(isset( $atts['forced_locale'] )){
        $lang = '&forced_locale=' . $atts['forced_locale'];
    }else{
        $lang = '';
    }
	$link = get_caag_hq_rental_my_package_reservation_link($caag_id) . '&forced_locale=' . $lang;
	return '<iframe id="caag-rental-iframe" src="' . $link . $lang . '" scrolling="no"></iframe>';
}
add_shortcode('hq_rental_forms_my_package_reservation', 'caag_hq_rental_forms_my_package_reservation');