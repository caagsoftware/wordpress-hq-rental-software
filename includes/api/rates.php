<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 2018-07-04
 * Time: 6:34 PM
 */



function caag_hq_get_api_rates()
{
    $args = caag_hq_api_get_basic_header();
    $endpoint = caag_hq_get_rates_endpoint();
    //Add Brand ID Option
    $args['body']['brand_id'] = '1';
    $response = wp_remote_get($endpoint, $args);
    return json_decode($response['body']);
}