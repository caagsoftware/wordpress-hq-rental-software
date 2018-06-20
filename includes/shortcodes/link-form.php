<?php

/*
 * HQ Rental Form Shortcode
 * @args array : caag_form_id
 * @return string: html code
 */
function caag_hq_rental_link_form($atts = [])
{
	if( isset( $atts['link'] ) ){
		caag_hq_rental_styles();
		caag_hq_rental_scripts();
        $link = $atts['link'];
		if(isset( $atts['forced_locale'] )){
            $lang = '&forced_locale=' . $atts['forced_locale'];
        }else{
		    $lang = '';
        }
		return '<iframe id="caag-rental-iframe" src="' . $link . $lang . '" scrolling="no"></iframe>';
	}else {
	}
}
add_shortcode('hq_rental_link_form', 'caag_hq_rental_link_form');