<?php

/*
 *
 */
function caag_hq_rental_forms_my_reservations($atts = [])
{
	caag_hq_rental_styles();
	caag_hq_rental_scripts();
	$caag_id = $atts['id'];
	$link = get_caag_hq_rental_my_reservation_link($caag_id);

	return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
}

add_shortcode('caag_hq_rental_forms_my_reservations', 'caag_hq_rental_forms_my_reservations');