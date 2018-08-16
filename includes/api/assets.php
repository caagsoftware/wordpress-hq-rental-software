<?php

function caag_hq_get_assets_files_urls()
{
        $args = caag_hq_api_get_basic_header();
        $endpoint = caag_hq_get_assets_endpoint();
        $response = wp_remote_get($endpoint, $args);
        return json_decode($response['body']);
}