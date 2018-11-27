<?php

/*
* Shortcode for Miami Tenant
*/
function caag_car_rental_shortcode_miami($atts = [])
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
            $output = '<form action="' . "https://up-miami.caagcrm.com/public/car-rental/reservations/step1?new=1&brand=f9d6f7b8-195a-409f-bc83-f5444f5b790e" . '" method="POST" target="caag-rental-iframe" id="caag_form_init">
                    <input type="hidden" name="pick_up_date" id="pick_up_date" value="' .
                $pickup_date->toDateString() . '"/>
                    <input type="hidden" name="return_date" id="return_date" value="' .
                $return_date->toDateString() . '"/>
                    <input type="hidden" name="pick_up_time" id="pick_up_time" value="' .
                $pickup_date->format('H:i') . '"/>
                    <input type="hidden" name="return_time" id="return_time" value="' .
                $return_date->format('H:i') . '"/>
                    <input type="hidden" name="pick_up_location" value="' . $pick_up_location . '"/>
                    <input type="hidden" name="return_location" value="' . $return_location . '"/>
                    <input type="hidden" name="pick_up_location_custom" id="pick_up_location_custom" value="' . $pick_up_location_custom . '"/>
                    <input type="submit" style="display: none;">
                </form>';
            $output .= '<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . "https://up-miami.caagcrm.com/public/car-rental/reservations/recover-last-booking?brand_uuid=f9d6f7b8-195a-409f-bc83-f5444f5b790e" . '" scrolling="no"></iframe>';

            caag_hq_rental_inline_script();
            return $output;
        }
    } catch (Exception $exception) {

    }
    return '<iframe id="caag-rental-iframe" src="' . "https://up-miami.caagcrm.com/public/car-rental/reservations/recover-last-booking?brand_uuid=f9d6f7b8-195a-409f-bc83-f5444f5b790e" . '" scrolling="no"></iframe>';
}
add_shortcode('caag_hq_rental_forms_miami', 'caag_car_rental_shortcode_miami');