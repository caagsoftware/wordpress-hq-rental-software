<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/13/2017
 * Time: 8:09 AM
 */

function caag_car_rental_shortcode($atts = [])
{
	
	$output = '<div id="caag-form">
					<iframe id="caag-iframe" src="' . $link . '">
	                </iframe>
                </div>';
	return $output;
}

add_shortcode('caag_rental_forms','caag_car_rental_shortcode');