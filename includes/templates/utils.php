<?php

function caag_hq_get_custom_url($url)
{
    return esc_url( home_url() . $url );
}



function caag_hq_format_rate_dollars($rate)
{
    return '$' . $rate . '/day';
}