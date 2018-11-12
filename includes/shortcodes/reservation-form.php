<?php

use Carbon\Carbon;

/*
 * HQ Rental Reservation Shortcode
 * @input caag_form_id
 * @return html string
 */
function caag_hq_rental_shortcode($atts = [])
{
	caag_hq_rental_styles();
	caag_hq_rental_scripts();
	$caag_id = $atts['id'];
	$new = $atts['new'];
    $passenger = get_data_from_post_var( 'passengers_number' );
    $custom_field_filter = $_POST['f218'];
    $custom_field_filter_luso = $_POST['f215'];
    if( !empty($vehicle_class_id) ){
        $single_vehicle = '&vehicle_class_id=' . $vehicle_class_id;
    }else{
        $single_vehicle = '';
    }
    if( !empty($new) ){
        $new_iframe = '&new=1';
    }else{
        $new_iframe = '';
    }
    if(isset( $atts['forced_locale'] )){
        $lang = '&forced_locale=' . $atts['forced_locale'];
    }else{
        $lang = '';
    }
    if( !empty( $passenger ) ){
        $vehicles = caag_hq_get_vehicle_classes_ids_by_passengers_numbers( (int)$passenger );
        $query_string_passenger = caag_hq_get_query_string_passenger($vehicles);
    }else{
        $query_string_passenger = '';
    }
    $vehicles_class_post = get_data_from_post_var( 'vehicle_class_id' );
    if( !empty( $vehicles_class_post ) ){
        $vehicles_from_post = '&vehicle_class_id=' . $vehicles_class_post;
    }else{
        $vehicles_from_post = '';
    }

    /*
     * Filter By Custom Field
     */
    if( !empty( $custom_field_filter ) ){
        $vehicles_filters = caag_hq_get_vehicle_classes_for_display_by_brand_id_and_custom_field(1, '218', $_POST['f218']);
        $query_string_vehicles_filter = caag_hq_get_query_string_from_custom_field_query($vehicles_filters);
    }else{
        $query_string_vehicles_filter = '';
    }
    /*
     * Filter Luso
     *
     */
    if( !empty( $custom_field_filter_luso ) ){
        $vehicles_filters_luso = caag_hq_get_vehicle_classes_for_display_by_brand_id_and_custom_field($_POST['brand_id'], '215', $_POST['f215']);
        $query_string_vehicles_filter_luso = caag_hq_get_query_string_from_custom_field_query($vehicles_filters_luso);
    }else{
        $query_string_vehicles_filter_luso = '';
    }

    $front_date_format = get_option( CAAG_HQ_RENTAL_FRONTEND_DATE_FORMAT );
    $system_date_format = get_option( CAAG_HQ_RENTAL_SYSTEM_DATE_FORMAT );
	$link = get_caag_hq_rental_link($caag_id) . $lang . $query_string_passenger . $new_iframe . $query_string_vehicles_filter .$query_string_vehicles_filter_luso;
	$first_step_link = get_caag_hq_rental_first_step_link($caag_id) . $lang . $query_string_passenger . $single_vehicle . $vehicles_from_post . $new_iframe . $query_string_vehicles_filter . $query_string_vehicles_filter_luso;
    if(get_data_from_post_var('new_reservation_to_step_4') == '1'){
	    return do_shortcode('[hq_rental_reservation_form_step_4 base_link='. $atts['base_link'] .']');
	}else{
        try {
            if (get_data_from_post_var('pick_up_date')) {
                if (get_data_from_post_var('pick_up_time')) {
                    $pickup_date = Carbon::createFromFormat( $front_date_format, get_data_from_post_var('pick_up_date') . ' ' . get_data_from_post_var('pick_up_time'));
                    $return_date = Carbon::createFromFormat( $front_date_format, get_data_from_post_var('return_date') . ' ' . get_data_from_post_var('return_time'));
                } else {
                    $pickup_date = Carbon::createFromFormat( $front_date_format, get_data_from_post_var('pick_up_date'));
                    $return_date = Carbon::createFromFormat( $front_date_format, get_data_from_post_var('return_date'));
                }
                $pick_up_location = get_data_from_post_var('pick_up_location');
                $pick_up_location_custom = get_data_from_post_var('pick_up_location_custom');
                $return_location_custom = get_data_from_post_var('return_location_custom');
                $return_location = get_data_from_post_var('return_location');
                $email = get_data_from_post_var('email');
                    $output = '<form action="' . $first_step_link . '" method="POST" target="caag-rental-iframe" id="caag_form_init">
                    <input type="hidden" name="pick_up_date" id="pick_up_date" value="' .
                        $pickup_date->format(caag_hq_get_date_format( $system_date_format )) . '"/>
                    <input type="hidden" name="return_date" id="return_date" value="' .
                        $return_date->format(caag_hq_get_date_format( $system_date_format )) . '"/>
                    <input type="hidden" name="pick_up_time" id="pick_up_time" value="' .
                        $pickup_date->format( caag_hq_get_time_format( $system_date_format )) . '"/>
                    <input type="hidden" name="return_time" id="return_time" value="' .
                        $return_date->format( caag_hq_get_time_format( $system_date_format )) . '"/>
                    <input type="hidden" name="pick_up_location" value="' . $pick_up_location . '"/>
                    <input type="hidden" name="email" value="' . $email . '"/>
                    <input type="hidden" name="return_location" value="' . $return_location . '"/>
                    <input type="hidden" name="pick_up_location_custom" id="pick_up_location_custom" value="' . $pick_up_location_custom . '"/>
                    <input type="hidden" name="return_location_custom" id="return_location_custom" value="' . $return_location_custom . '"/>
                    <input type="submit" style="display: none;">
                </form>';
                $output .= '<iframe id="caag-rental-iframe" name="caag-rental-iframe" src="' . $link . $new_iframe . '" scrolling="no"></iframe>';
                caag_hq_rental_inline_script();
                return $output;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

	}
    if(isset($_GET['vehicle_class_id'])){
        $class_id = $_GET['vehicle_class_id'];
        $output .= '<iframe id="caag-rental-iframe" src="'. $link . $new_iframe . '&new=true&vehicle_class_id='. $class_id .'" scrolling="no"></iframe>';
    }else{
        $output .= '<iframe id="caag-rental-iframe" src="'. $link . $new_iframe . '" scrolling="no"></iframe>';
    }
	return $output;
}
add_shortcode('hq_rental_reservation_form', 'caag_hq_rental_shortcode');