<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/13/2017
 * Time: 8:09 AM
 */
require_once 'Carbon.php';
use Carbon\Carbon;

function caag_car_rental_shortcode($atts = [])
{
	caag_rental_styles();
	caag_rental_scripts();
	$caag_id = $atts['id'];
	$link = get_caag_rental_link($caag_id);
	if(isset($_GET['pickup_date']) and isset($_GET['return_date']) and isset($_GET['pickup_location']) and isset($_GET['pick_up_location_custom'])){
		$pickup_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['pickup_date']));
		$return_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['return_date']));
		$pick_up_location = $_GET['pickup_location'];
		$pick_up_location_custom = $_GET['pick_up_location_custom'];
		$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
		$output .= '<form action="https://jansen-car-rental.jansencarrental.com/public/car-rental/reservations/step1?new=true&brand=001eb36a-ecb0-4c0d-b691-510a3a8f76e1&vehicle_class_id=" method="POST" target="caag-rental-iframe" id="reserve_form" hidden="hidden">
						<input hidden="hidden" type="text" autocomplete="off" name="pick_up_date" id="pick_up_date" value="'.$pickup_date->toDateString().'"/>
						<input hidden="hidden" type="text" autocomplete="off" name="return_date" id="return_date" value="'.$return_date->toDateString().'"/>
						<input hidden="hidden" type="text" autocomplete="off" name="pick_up_time" id="pick_up_time" value="'.$pickup_date->toTimeString().'"/>
						<input hidden="hidden" type="text" autocomplete="off" name="return_time" id="return_time" value="'.$return_date->toTimeString().'"/>
						<input hidden="hidden" type="radio" name="pick_up_location" value="'.$pick_up_location.'" checked="checked"/>
						<input hidden="hidden" type="radio" name="pick_up_location" value="custom"/>
						<input hidden="hidden" type="text" autocomplete="off" name="pick_up_location_custom" id="pick_up_location_custom" value="'.$pick_up_location_custom.'"/>
					</form>';
		$output .= '<script type="text/javascript">
				(function ($) {
					"use strict";
					$(document).ready(function () {
						$(\'#reserve_form\').submit();
					})
				})(jQuery);
			</script>';
		return $output;
	}else{
		$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
		return $output;
	}

}
add_shortcode('caag_rental_forms','caag_car_rental_shortcode');
