<?php

require_once 'Carbon.php';

use Carbon\Carbon;

/*
 * 
 */
function caag_car_rental_shortcode($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];
    $link = get_caag_hq_rental_link($caag_id);
    $first_step_link = get_caag_hq_rental_first_step_link($caag_id);
        if (isset($_GET['pickup_date']) and isset($_GET['return_date']) and (isset($_GET['pickup_location']) or isset($_GET['pick_up_location_custom']))) {
        $pickup_date = Carbon::createFromFormat('Y-m-d H:i', str_replace('/', '-', $_GET['pickup_date']));
        $return_date = Carbon::createFromFormat('Y-m-d H:i', str_replace('/', '-', $_GET['return_date']));
        $pick_up_location = $_GET['pickup_location'];
        $pick_up_location_custom = $_GET['pick_up_location_custom'];
        if ($pick_up_location == '1' or $pick_up_location == '2') {
            $output = '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
            $output .= '<form action="' . $first_step_link . '" method="POST" target="caag-rental-iframe" id="reserve_form" hidden="hidden">
						<input type="text" autocomplete="off" name="pick_up_date" id="pick_up_date" value="' .
                       $pickup_date->toDateString() . '"/>
						<input type="text" autocomplete="off" name="return_date" id="return_date" value="' .
                       $return_date->toDateString() . '"/>
						<input type="text" autocomplete="off" name="pick_up_time" id="pick_up_time" value="' .
                       $pickup_date->format('H:i') . '"/>
						<input type="text" autocomplete="off" name="return_time" id="return_time" value="' .
                       $return_date->format('H:i') . '"/>
						<input type="radio" name="pick_up_location" value="' . $pick_up_location . '" checked="checked"/>
						<input type="radio" name="pick_up_location" value="custom"/>
						<input type="text" autocomplete="off" name="pick_up_location_custom" id="pick_up_location_custom" value="' .
                       $pick_up_location_custom . '"/>
					</form>';
            caag_hq_rental_inline_script();

            return $output;
        } else {
            return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
        }
    } else {
        return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
    }

}

add_shortcode('caag_hq_rental_forms', 'caag_car_rental_shortcode');


/*
 *
 */
function caag_hq_rental_forms_packages($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];

    return '<iframe id="caag-rental-iframe" src="' . get_caag_hq_rental_package_link($caag_id) .
           '" scrolling="no"></iframe>';
}

add_shortcode('caag_hq_rental_forms_packages', 'caag_hq_rental_forms_packages');


/*
 *
 */
function caag_hq_rental_forms_reservation_packages($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];
    $link = get_caag_hq_rental_reservation_package_link($caag_id);

    return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
}

add_shortcode('caag_hq_rental_forms_reservation_packages', 'caag_hq_rental_forms_reservation_packages');


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


/*
 *
 */
function caag_hq_rental_forms_my_package_reservation($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];
    $link = get_caag_hq_rental_my_package_reservation_link($caag_id);

    return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
}

add_shortcode('caag_hq_rental_forms_my_package_reservation', 'caag_hq_rental_forms_my_package_reservation');
