<?php

use Carbon\Carbon;

/*
 * HQ Rental Reservation Shortcode
 * @input caag_form_id
 * @return html string
 */
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
				if(get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == 'YYYY-MM-DD'){
					$pickup_date = Carbon::createFromFormat('Y-m-d H:i',
						get_data_from_post_var('pick_up_date') . ' ' . get_data_from_post_var('pick_up_time'));
					$return_date = Carbon::createFromFormat('Y-m-d H:i',
						get_data_from_post_var('return_date') . ' ' . get_data_from_post_var('return_time'));
				} elseif (get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == 'DD-MM-YYYY'){
					$pickup_date = Carbon::createFromFormat('d-m-Y H:i',
						get_data_from_post_var('pick_up_date') . ' ' . get_data_from_post_var('pick_up_time'));
					$return_date = Carbon::createFromFormat('d-m-Y H:i',
						get_data_from_post_var('return_date') . ' ' . get_data_from_post_var('return_time'));
				}
			} else {
				if(get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == 'YYYY-MM-DD'){
					$pickup_date = Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('pick_up_date'));
					$return_date = Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('return_date'));
				} elseif (get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == 'DD-MM-YYYY'){
					$pickup_date = Carbon::createFromFormat('d-m-Y H:i', get_data_from_post_var('pick_up_date'));
					$return_date = Carbon::createFromFormat('d-m-Y H:i', get_data_from_post_var('return_date'));
				}
			}
			$pick_up_location = get_data_from_post_var('pick_up_location');
			$pick_up_location_custom = get_data_from_post_var('pick_up_location_custom');
			$return_location = get_data_from_post_var('return_location');
			$email = get_data_from_post_var('email');
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
                    <input type="hidden" name="email" value="' . $email . '"/>
                    <input type="hidden" name="return_location" value="' . $return_location . '"/>
                    <input type="hidden" name="pick_up_location_custom" id="pick_up_location_custom" value="' . $pick_up_location_custom . '"/>
                    <input type="submit" style="display: none;">
                </form>';
			$output .= '<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . '" scrolling="no"></iframe>';
			caag_hq_rental_inline_script();
			return $output;
		}
	} catch (Exception $exception) {
	}
	$output .= '<iframe id="caag-rental-iframe" src="'. $link . '" scrolling="no"></iframe>';
	return $output;
}
add_shortcode('hq_rental_reservation_form', 'caag_hq_car_rental_shortcode');