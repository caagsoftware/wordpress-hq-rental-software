<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/12/2017
 * Time: 10:37 PM
 */
require_once 'HttpClient.php';

add_action('pre_get_posts','caag_rental_update_forms');
function caag_rental_update_forms()
{
	$client = new HttpClient();
	$data = $client->get(CAAG_RENTAL_API_GET_CALLS);
	print_r($data->fleets_brands);
	die();
}