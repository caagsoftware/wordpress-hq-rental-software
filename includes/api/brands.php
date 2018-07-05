<?php


function caag_hq_get_brands()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_brands_endpoint();
    //Add Brand ID Option
    $args['body']['brand_id'] = '1';
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}