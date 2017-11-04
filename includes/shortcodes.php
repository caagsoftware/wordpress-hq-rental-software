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
	$first_step_link = get_caag_rental_first_step_link($caag_id);

	if(isset($_GET['pickup_date']) and isset($_GET['return_date']) and (isset($_GET['pickup_location']) or isset($_GET['pick_up_location_custom']))){
		$pickup_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['pickup_date']));
		$return_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['return_date']));
		$pick_up_location = $_GET['pickup_location'];
		$pick_up_location_custom = $_GET['pick_up_location_custom'];
		$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
		$output .= '<form action="'.$first_step_link.'" method="POST" target="caag-rental-iframe" id="reserve_form" hidden="hidden">
						<input type="text" autocomplete="off" name="pick_up_date" id="pick_up_date" value="'.$pickup_date->toDateString().'"/>
						<input type="text" autocomplete="off" name="return_date" id="return_date" value="'.$return_date->toDateString().'"/>
						<input type="text" autocomplete="off" name="pick_up_time" id="pick_up_time" value="'.$pickup_date->format('H:i').'"/>
						<input type="text" autocomplete="off" name="return_time" id="return_time" value="'.$return_date->format('H:i').'"/>
						<input type="radio" name="pick_up_location" value="'.$pick_up_location.'" checked="checked"/>
						<input type="radio" name="pick_up_location" value="custom"/>
						<input type="text" autocomplete="off" name="pick_up_location_custom" id="pick_up_location_custom" value="'.$pick_up_location_custom.'"/>
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


function caag_rental_forms_packages($atts = [])
{
	caag_rental_styles();
	caag_rental_scripts();
	$caag_id = $atts['id'];
	$link = get_caag_rental_package_link($caag_id);
	$first_step_link = get_caag_rental_package_first_step_link($caag_id);
	if(isset($_GET['pickup_date']) or isset($_GET['return_date'])){
		$pickup_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['pickup_date']));
		$return_date = Carbon::createFromFormat("Y-m-d H:i", str_replace('/','-', $_GET['return_date']));
		$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
		$output .= '<form action="'.$first_step_link.'" method="POST" target="caag-rental-iframe" id="reserve_form" hidden="hidden">
						<input type="text" autocomplete="off" name="pick_up_date_date" id="pick_up_date_date" value="'.$pickup_date->toDateString().'"/>
						<input type="text" autocomplete="off" name="return_date_date" id="return_date_date" value="'.$return_date->toDateString().'"/>
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
	}
	$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
	return $output;
}
add_shortcode('caag_rental_forms_packages', 'caag_rental_forms_packages');

function caag_rental_forms_reservation_packages($atts = [])
{
	caag_rental_styles();
	caag_rental_scripts();
	$caag_id = $atts['id'];
	$link = get_caag_rental_reservation_package_link($caag_id);
	$output = '<div id="caag-rental-form">
						<iframe id="caag-rental-iframe" src="' . $link . '"></iframe>
					</div>';
	return $output;
}
add_shortcode('caag_rental_forms_reservation_packages', 'caag_rental_forms_reservation_packages');