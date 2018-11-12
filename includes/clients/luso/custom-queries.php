<?php

function caag_hq_get_all_brands_for_menu_items()
{
    $brands = caag_hq_get_brands_for_display();
    $return_data = array();
    foreach ( $brands as $brand ){
        $newData = new stdClass();
        $newData->brand_id = $brand->id;
        $newData->brand_name = $brand->name;
        $newData->brand_page = $brand->page_link;
        $makes = [];
        $vehicles_classes = caag_hq_get_vehicle_classes_for_display_by_brand_id( $brand->id );
        foreach ($vehicles_classes as $vehicle){
            if(! in_array($vehicle->f215, $makes) ){
                $makes[] = $vehicle->f215;
            }
        }
        $newData->makes = custom_sort( $makes );
        $return_data[$brand->id] = $newData;
    }
    return $return_data;
}

function caag_hq_get_all_types_items()
{
    $brands = caag_hq_get_brands_for_display();
    $return_data = array();
    foreach ( $brands as $brand ){
        $newData = new stdClass();
        $newData->brand_id = $brand->id;
        $types = [];
        $vehicles_classes = caag_hq_get_vehicle_classes_for_display_by_brand_id( $brand->id );
        foreach ($vehicles_classes as $vehicle){
            if(! in_array($vehicle->f225, $types) and !(empty($vehicle->f225)) ){
                $types[] = $vehicle->f225;
            }
        }
        $newData->types = custom_sort( $types );
        $return_data[$brand->id] = $newData;
    }
    return $return_data;
}

function caag_hq_get_makes_by_brands($brand_id, $current_page)
{
    $vehicles_classes = caag_hq_get_vehicle_classes_for_display_by_brand_id( $brand_id );
    $makes = array();
    $data_return = array();
    foreach ($vehicles_classes as $vehicle) {
        if (!in_array($vehicle->f215, $makes)) {
            $makes[] = $vehicle->f215;
            $new_data = new stdClass();
            $new_data->make = $vehicle->f215;
            $new_data->urlFilter = $current_page . '?brand_id=' . $brand_id . '&make=' . $vehicle->f215;
            $data_return[] = $new_data;
        }
    }
    usort($data_return, "caag_hq_order_by_make");
    return $data_return;
}

function caag_hq_get_makes_by_brand_id($brand_id)
{
    $vehicles_classes = caag_hq_get_vehicle_classes_for_display_by_brand_id( $brand_id );
    $makes = array();
    foreach ($vehicles_classes as $vehicle) {
        if (!in_array($vehicle->f215, $makes)) {
            $makes[] = $vehicle->f215;
        }
    }
    return custom_sort( $makes );
}

function caag_hq_get_types_by_brand_id($brand_id)
{
    $vehicles_classes = caag_hq_get_vehicle_classes_for_display_by_brand_id( $brand_id );
    $types = array();
    foreach ($vehicles_classes as $vehicle) {
        if (!in_array($vehicle->f225, $types) and !(empty($vehicle->f225))) {
            $types[] = $vehicle->f225;
        }
    }
    return custom_sort( $types );
}


function caag_hq_order_by_make($a, $b)
{
    return strcmp($a->make, $b->make);
}

function custom_sort( $array )
{
    sort($array);
    return $array;
}

/*
 * Filter By Brand - Type - Make
 */
function caag_hq_get_vehicle_classes_global_filter( $caag_brand_id, $make, $type )
{
    $args = array(
        'post_type'         =>  CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES,
        'post_status'       =>  'publish',
        'posts_per_page'    =>  -1,
        'meta_query'        =>  array(
            'key'       =>  CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META,
            'value'     =>  $caag_brand_id,
            'compare'   =>  '='
        )
    );

    $query = new WP_Query( $args );
    $vehicles = array();
    foreach( $query->posts as $vehicle ){
        $new_vehicle = new stdClass();
        $new_vehicle->id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ID_META, true );
        $new_vehicle->post_id = $vehicle->ID;
        $new_vehicle->brand_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_BRAND_ID_META, true );
        $new_vehicle->name = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_NAME_META, true );
        $new_vehicle->active = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_META, true );
        $new_vehicle->recommended = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_RECOMENDED_META, true );
        $new_vehicle->label_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_EN_META, true );
        $new_vehicle->short_description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->description_en = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_EN_META, true );
        $new_vehicle->label_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_NL_META, true );
        $new_vehicle->short_description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->description_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_NL_META, true );
        $new_vehicle->label_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_LABEL_FOR_WEBSITE_DE_META, true );
        $new_vehicle->short_description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_SHORT_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->description_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_DESCRIPTION_FOR_WEBSITE_DE_META, true );
        $new_vehicle->image_link = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_LINK_META, true );
        $new_vehicle->image_link_extension = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_IMAGE_EXTENSION_META, true );
        $new_vehicle->active_rate_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_ID_META, true );
        $new_vehicle->active_rate_season_id = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_SEASON_ID_META, true );
        $new_vehicle->base_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_META, true );
        $new_vehicle->hourly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_META, true );
        $new_vehicle->daily_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_META, true );
        $new_vehicle->weekly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_META, true );
        $new_vehicle->monthly_rate = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_META, true );
        $new_vehicle->base_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_BASE_RATE_PLUS_TAX_META, true );
        $new_vehicle->hourly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_HOURLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->daily_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DAILY_RATE_PLUS_TAX_META, true );
        $new_vehicle->weekly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_WEEKLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->monthly_rate_plus_tax = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_MONTHLY_RATE_PLUS_TAX_META, true );
        $new_vehicle->inb_de = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F214_META, true );
        $new_vehicle->f215 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F215_META, true );
        $new_vehicle->f216 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F216_META, true );
        $new_vehicle->f217 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F217_META, true );
        $new_vehicle->f218 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F218_META, true );
        $new_vehicle->f219 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F219_META, true );
        $new_vehicle->f220 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F220_META, true );
        $new_vehicle->f221 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F221_META, true );
        $new_vehicle->f225 = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F225_META, true );
        $new_vehicle->passengers = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F222_META, true );
        $new_vehicle->tech_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F226_META, true );
        $new_vehicle->inb_nl = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F227_META, true );
        $new_vehicle->rating = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_CUSTOM_FIELD_F235_META, true );
        $new_vehicle->decreasing_rate_based_on_intervals = get_post_meta( $vehicle->ID, CAAG_HQ_RENTAL_VEHICLE_CLASS_ACTIVE_RATE_DECREASING_RATES_BASED_ON_INTERVALS_META, true );
        if(($new_vehicle->f215 === $make) and ($new_vehicle->f225 === $type)){
            $vehicles[] = $new_vehicle;
        }
    }
    return $vehicles;
}
