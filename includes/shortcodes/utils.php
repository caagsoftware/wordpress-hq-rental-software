<?php


function caag_hq_get_query_string_passenger($vehicles)
{
    $query_string_passenger = '&vehicle_classes_filter=';
    $counter = 0;
    foreach ( $vehicles as $vehicle ){
        $counter = $counter + 1;
        if($counter == count($vehicles)){
            $query_string_passenger .= get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        }else{
            $query_string_passenger .= get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true ) . ',';
        }
    }
    return $query_string_passenger;
}

function caag_hq_get_query_string_additional_charges($charges)
{
    //https://camperrent.caagcrm.com/public/car-rental/reservations/step4?new=1&brand=736fab41-a47f-4668-b48c-1252835f9a14&pick_up_date=2018-09-03&return_date=2018-09-10&return_time=14:00&pick_up_time=14:00&vehicle_class_id=15&selected_insurances[]=11&selected_insurances[]=4&selected_insurances[]=10
    $output = '';
    foreach($charges as $charge){
        if($charge['selection_type'] == 'only_one'){
            $output .= '&selected_insurances[]=' . $charge['id'];
        }else if($charge['selection_type'] == 'multiple'){
            $output .= '&selected_insurances[]=' . $charge['id'] . '_' . $charge['value'];
        }else{
            $output .= '&selected_insurances[]=' . $charge['id'];
        }
    }
    return $output;
}