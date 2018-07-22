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