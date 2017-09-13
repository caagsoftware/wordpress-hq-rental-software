<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/13/2017
 * Time: 8:09 AM
 */

function caag_car_rental_shortcode($atts = [])
{
	caag_rental_styles();
	caag_rental_scripts();
	$caag_id = $atts['id'];
	$link = get_caag_rental_link($caag_id);
	$output = '<div id="caag-rental-form">
					<iframe id="caag-rental-iframe" src="' . $link . '">
	                </iframe>
                </div>';
	return $output;
}
add_shortcode('caag_rental_forms','caag_car_rental_shortcode');
