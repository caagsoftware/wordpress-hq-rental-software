<?php

require_once 'Carbon.php';

use Carbon\Carbon;

function caag_car_rental_shortcode($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];
    $link = get_caag_hq_rental_link($caag_id);
    $first_step_link = get_caag_hq_rental_first_step_link($caag_id);

    try {
        if (get_data_from_post_var('pick_up_date')) {
            if (get_data_from_post_var('pick_up_time')) {
                $pickup_date = Carbon::createFromFormat('Y-m-d H:i',
                    get_data_from_post_var('pick_up_date') . ' ' . get_data_from_post_var('pick_up_time'));
                $return_date = Carbon::createFromFormat('Y-m-d H:i',
                    get_data_from_post_var('return_date') . ' ' . get_data_from_post_var('return_time'));
            } else {
                $pickup_date = Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('pick_up_date'));
                $return_date = Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('return_date'));
            }
            $pick_up_location = get_data_from_post_var('pick_up_location');
            $pick_up_location_custom = get_data_from_post_var('pick_up_location_custom');

            $output = '<form action="' . $first_step_link . '" method="POST" target="caag-rental-iframe" id="caag_form_init">
						<input type="hidden" name="pick_up_date" id="pick_up_date" value="' .
                       $pickup_date->toDateString() . '"/>
						<input type="hidden" name="return_date" id="return_date" value="' .
                       $return_date->toDateString() . '"/>
						<input type="hidden" name="pick_up_time" id="pick_up_time" value="' .
                       $pickup_date->format('H:i') . '"/>
						<input type="hidden" name="return_time" id="return_time" value="' .
                       $return_date->format('H:i') . '"/>
						<input type="hidden" name="pick_up_location" value="' . $pick_up_location . '"/>
						<input type="hidden" name="pick_up_location_custom" id="pick_up_location_custom" value="' . $pick_up_location_custom . '"/>
						<input type="submit" style="display: none;">
					</form>';
            $output .= '<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';

            caag_hq_rental_inline_script();

            return $output;
        }
    } catch (Exception $exception) {

    }

    return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';

}

add_shortcode('caag_hq_rental_forms', 'caag_car_rental_shortcode');


function caag_hq_rental_forms_packages($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];

    return '<iframe id="caag-rental-iframe" src="' . get_caag_hq_rental_package_link($caag_id) .
           '" scrolling="no"></iframe>';
}

add_shortcode('caag_hq_rental_forms_packages', 'caag_hq_rental_forms_packages');

function caag_hq_rental_forms_reservation_packages($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $caag_id = $atts['id'];
    $link = get_caag_hq_rental_reservation_package_link($caag_id);

    return '<iframe id="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
}

function get_data_from_post_var($data)
{
    return $_POST[$data];
}

add_shortcode('caag_hq_rental_forms_reservation_packages', 'caag_hq_rental_forms_reservation_packages');
