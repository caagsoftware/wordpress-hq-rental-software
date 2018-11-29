<?php
/*
 * Shortcode for Fort Lauderdale Tenant
 */
function caag_car_rental_shortcode_fort_lauderdale($atts = [])
{

    caag_hq_rental_styles();
    caag_hq_rental_scripts();
    try {
        if (get_data_from_post_var('pick_up_date')) {
            if (get_data_from_post_var('pick_up_time')) {
                $pickup_date = Carbon\Carbon::createFromFormat('Y-m-d H:i',
                    get_data_from_post_var('pick_up_date') . ' ' . get_data_from_post_var('pick_up_time'));
                $return_date = Carbon\Carbon::createFromFormat('Y-m-d H:i',
                    get_data_from_post_var('return_date') . ' ' . get_data_from_post_var('return_time'));
            } else {
                $pickup_date = Carbon\Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('pick_up_date'));
                $return_date = Carbon\Carbon::createFromFormat('Y-m-d H:i', get_data_from_post_var('return_date'));
            }
            $pick_up_location = get_data_from_post_var('pick_up_location');
            $return_location = get_data_from_post_var('return_location');
            $output = '<form action="' . "https://up-fort-lauderdale.caagcrm.com/public/car-rental/reservations/step1?new=1&brand=b5519f4d-10a2-4472-a954-d5aab7966f32&forced_locale=pt" . '" method="POST" target="caag-rental-iframe" id="caag_form_init">
                    <input type="hidden" name="pick_up_date" id="pick_up_date" value="' .
                $pickup_date->format('Y-m-d') . '"/>
                    <input type="hidden" name="return_date" id="return_date" value="' .
                $return_date->format('Y-m-d') . '"/>
                    <input type="hidden" name="pick_up_time" id="pick_up_time" value="' .
                $pickup_date->format('H:i') . '"/>
                    <input type="hidden" name="return_time" id="return_time" value="' .
                $return_date->format('H:i') . '"/>
                    <input type="hidden" name="pick_up_location" value="' . $pick_up_location . '"/>
                    <input type="hidden" name="return_location" value="' . $return_location . '"/>
                    <input type="hidden" name="pick_up_location_custom" id="pick_up_location_custom" value="' . $pick_up_location_custom . '"/>
                    <input type="submit" style="display: none;">
                </form>';
            $output .= '<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . "https://up-fort-lauderdale.caagcrm.com/public/car-rental/reservations/recover-last-booking?brand_uuid=b5519f4d-10a2-4472-a954-d5aab7966f32&forced_locale=pt" . '" scrolling="no"></iframe>';

            caag_hq_rental_inline_script();
            return $output;
        }
    } catch (Exception $exception) {
    }
    return '<iframe id="caag-rental-iframe" src="' . "https://up-fort-lauderdale.caagcrm.com/public/car-rental/reservations/recover-last-booking?brand_uuid=b5519f4d-10a2-4472-a954-d5aab7966f32&forced_locale=pt" . '" scrolling="no"></iframe>';
}

add_shortcode('caag_car_rental_shortcode_fort_lauderdale', 'caag_car_rental_shortcode_fort_lauderdale');