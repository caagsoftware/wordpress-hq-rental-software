<?php

/*
 * HQ Rental My Package Reservation Form Shortcode
 * @args array : caag_form_id
 * @return string: html code
 */
function caag_hq_rental_forms_packages($atts = [])
{
	caag_hq_rental_styles();
	caag_hq_rental_scripts();
	$caag_id = $atts['id'];
	return '<iframe id="caag-rental-iframe" src="' . get_caag_hq_rental_package_link($caag_id) . '" scrolling="no"></iframe>';
}
add_shortcode('caag_hq_rental_forms_packages', 'caag_hq_rental_forms_packages');