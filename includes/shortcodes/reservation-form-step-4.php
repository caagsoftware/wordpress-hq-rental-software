<?php
use Carbon\Carbon;

/*
 * HQ Rental Reservation Shortcode
 * @input caag_form_id
 * @return html string
 */
function caag_hq_rental_reservation_form_step_4($atts = [])
{
    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    $base_link = $atts['base_link'];
    $pickup_times = '&pick_up_date=' . get_data_from_post_var('pick_up_date') . '&pick_up_time=' . get_data_from_post_var('pick_up_time');
    $return_times = '&return_date=' . get_data_from_post_var('return_date') . '&return_time=' . get_data_from_post_var('return_time');
    $vehicle = '&vehicle_class_id=' . get_data_from_post_var('vehicle_class_id');
    $location = '&pick_up_location=' . get_data_from_post_var('pick_up_location');
    $charges = caag_hq_get_query_string_additional_charges(get_data_from_post_var('additional_charges'));
    $query_string = $base_link . $location . $pickup_times . $return_times . $vehicle . $charges;
    $output = '<iframe id="caag-rental-iframe" src="'. $query_string . '" scrolling="no"></iframe>';
    return $output;
}
add_shortcode('hq_rental_reservation_form_step_4', 'caag_hq_rental_reservation_form_step_4');