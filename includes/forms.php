<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/13/2017
 * Time: 8:19 AM
 */
require 'HttpClient.php';

add_action('pre_get_posts','caag_rental_form_index');
function caag_rental_form_index()
{
	$client = new HttpClient();
	$brands = $client->get(CAAG_RENTAL_API_GET_CALLS)->fleets_brands;
	foreach ($brands as $form){
		if(!caag_rental_exists($form->id)){
			$args = array(
				'post_title'    =>  $form->name,
				'post_status'   =>  'publish',
				'post_type'     =>  CAAG_RENTAL_CUSTOM_POST_TYPE
			);
			$post_id = wp_insert_post($args);
			add_post_meta($post_id, CAAG_RENTAL_CAAG_ID, $form->id);

			add_post_meta($post_id, CAAG_RENTAL_LINK, $form->public_reservations_link_full);
			add_post_meta($post_id, CAAG_RENTAL_SHORTCODE, '[caag_rental_forms id='.$form->id.' ]');
		}else{
			$post_id = get_caag_rental_by_meta($form->id);
			$args = array(
				'ID'    =>  $post_id,
				'title' =>  $form->name
			);
			wp_update_post($args);
			update_post_meta($post_id, CAAG_RENTAL_LINK, $form->public_reservations_link_full);
		}
	}
}

/*
 * Add Meta Data columns to Post Table: Link
 * Only Header and Footer
 */
add_filter('manage_'.CAAG_RENTAL_CUSTOM_POST_TYPE.'_posts_columns', 'add_meta_columns');
function add_meta_columns($defaults)
{
	$columns[CAAG_RENTAL_ID_COLUMN] = CAAG_RENTAL_ID_COLUMN;
	$columns[CAAG_RENTAL_NAME_COLUMN] = CAAG_RENTAL_NAME_COLUMN;
	$columns[CAAG_RENTAL_LINK_COLUMN] = CAAG_RENTAL_LINK_COLUMN;
	$columns[CAAG_RENTAL_SHORTCODE_COLUMN] = CAAG_RENTAL_SHORTCODE_COLUMN;
	return $columns;
}

/*
 * Displaying Actual Meta Data Values
 * return @void
 */
add_action( 'manage_posts_custom_column' , 'fill_meta_column_link', 10, 2 );
function fill_meta_column_link($column_name, $post_id)
{
	if ($column_name == CAAG_RENTAL_ID_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_CAAG_ID)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_CAAG_ID)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_RENTAL_NAME_COLUMN) {
		$post = get_post($post_id);
		echo $post->post_title;
	}

	if ($column_name == CAAG_RENTAL_LINK_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_LINK)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_LINK)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_RENTAL_SHORTCODE_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_SHORTCODE)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_SHORTCODE)[0];
		}else{
			echo '';
		}
	}
}