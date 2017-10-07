<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/13/2017
 * Time: 8:19 AM
 */
require 'HttpClientRental.php';

/*
 * Form Index Page
 * @param WpQuery
 * @return void
 */
add_action('pre_get_posts','caag_rental_form_index');
function caag_rental_form_index($query)
{
	if(isset($query->query['post_type']) and  $query->query['post_type'] == CAAG_RENTAL_CUSTOM_POST_TYPE) {
		$client = new HttpClientRental();
		$api = $client->get( CAAG_RENTAL_API_GET_CALLS );
		if ( ! is_null( $api->fleets_brands ) ) {
			$brands = $api->fleets_brands;
			foreach ( $brands as $form ) {
				if ( ! caag_rental_exists( $form->id ) ) {
					$args = array(
						'post_title'  => $form->name,
						'post_status' => 'publish',
						'post_type'   => CAAG_RENTAL_CUSTOM_POST_TYPE
					);
					$post_id = wp_insert_post( $args, true );
					add_post_meta( $post_id, CAAG_RENTAL_CAAG_ID, $form->id );
					add_post_meta( $post_id, CAAG_RENTAL_LINK, $form->public_reservations_link_full );
					add_post_meta( $post_id, CAAG_RENTAL_SHORTCODE, '[caag_rental_forms id=' . $form->id . ']' );
					add_post_meta( $post_id, CAAG_RENTAL_FIRST_STEP_LINK, $form->public_reservations_link_first_step );
					if( isset($form->public_packages_link_full) and $form->public_packages_link_full != ''){
						add_post_meta( $post_id, CAAG_RENTAL_PUBLIC_PACKAGES_LINK, $form->public_packages_link_full );
						add_post_meta( $post_id, CAAG_RENTAL_FIRST_STEP_LINK_PACKAGES, $form->public_packages_link_first_step );
						add_post_meta( $post_id, CAAG_RENTAL_SHORTCODE_PACKAGES, '[caag_rental_forms_packages id=' . $form->id . ']' );
					}
					if( isset($form->public_reservations_packages_link_first_step) and $form->public_reservations_packages_link_first_step != '' ){
						add_post_meta( $post_id, CAAG_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK, $form->public_reservations_packages_link_first_step );
						add_post_meta( $post_id, CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES, '[caag_rental_forms_reservation_packages id=' . $form->id . ']' );
					}
				} else {
					$post = get_caag_rental_by_meta( $form->id )[0];
					
					update_post_meta( (int)$post->post_id, CAAG_RENTAL_LINK, $form->public_reservations_link_full );
					update_post_meta( (int)$post->post_id, CAAG_RENTAL_FIRST_STEP_LINK, $form->public_reservations_link_first_step );
					update_post_meta( (int)$post->post_id, CAAG_RENTAL_SHORTCODE, '[caag_rental_forms id=' . $form->id . ']' );
					if( isset($form->public_packages_link_full) and $form->public_packages_link_full != '' ){
						update_post_meta( (int)$post->post_id, CAAG_RENTAL_PUBLIC_PACKAGES_LINK, $form->public_packages_link_full );
						update_post_meta( (int)$post->post_id, CAAG_RENTAL_FIRST_STEP_LINK_PACKAGES, $form->public_packages_link_first_step );
						update_post_meta( (int)$post->post_id, CAAG_RENTAL_SHORTCODE_PACKAGES, '[caag_rental_forms_packages id=' . $form->id . ']' );
					}
					if( isset($form->public_reservations_packages_link_first_step) and $form->public_reservations_packages_link_first_step != ''){
						update_post_meta( (int)$post->post_id, CAAG_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK, $form->public_reservations_packages_link_first_step );
						update_post_meta( (int)$post->post_id, CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES, '[caag_rental_forms_reservation_packages id=' . $form->id . ']' );
					}
					$args    = array(
						'ID'    => (int)$post->post_id,
						'title' => $form->name
					);
					wp_update_post( $args );
				}
			}
		} elseif( isset($api['curl_error']) ) {
			echo '<div class="notice notice-error"><p>'.$api['curl_error'].'</p></div>';
		} else {
			echo '<div class="notice notice-error"><p>'.$api->message.'</p></div>';
		}
	}
}

/*
 * Add Meta Data columns to Post Table: Link
 * Only Header and Footer
 */
add_filter('manage_'.CAAG_RENTAL_CUSTOM_POST_TYPE.'_posts_columns', 'caag_rental_add_meta_columns');
function caag_rental_add_meta_columns($defaults)
{
	$columns[CAAG_RENTAL_ID_COLUMN] = CAAG_RENTAL_ID_COLUMN;
	$columns[CAAG_RENTAL_NAME_COLUMN] = CAAG_RENTAL_NAME_COLUMN;
	$columns[CAAG_RENTAL_SHORTCODE_COLUMN] = CAAG_RENTAL_SHORTCODE_COLUMN;
	$columns[CAAG_RENTAL_SHORTCODE_PACKAGES_COLUMN] = CAAG_RENTAL_SHORTCODE_PACKAGES_COLUMN;
	$columns[CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN] = CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN;
	return $columns;
}

/*
 * Displaying Actual Meta Data Values
 * return @void
 */
add_action( 'manage_posts_custom_column' , 'caag_rental_fill_meta_columns', 10, 2 );
function caag_rental_fill_meta_columns($column_name, $post_id)
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
	if ($column_name == CAAG_RENTAL_SHORTCODE_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_SHORTCODE)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_SHORTCODE)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_RENTAL_SHORTCODE_PACKAGES_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_SHORTCODE_PACKAGES)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_SHORTCODE_PACKAGES)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES)[0])){
			echo get_post_meta($post_id, CAAG_RENTAL_SHORTCODE_RESERVATION_PACKAGES)[0];
		}else{
			echo '';
		}
	}

}


/*
 * Make Id and Title Table Header sortable
 * @param array
 * @return array
 */
add_filter( 'manage_edit-'.CAAG_RENTAL_CUSTOM_POST_TYPE.'_sortable_columns', 'caag_rental_all_sortable_columns' );
function caag_rental_all_sortable_columns( $columns )
{
	$columns[CAAG_RENTAL_ID_COLUMN] = 'Identifier';
	$columns[CAAG_RENTAL_NAME_COLUMN] = 'Name';
	return $columns;
}

/*
 * Orders Columns By Id and Title in Admin Table
 * @param WpQuery
 * @return void
 */
add_action( 'pre_get_posts', 'caag_rental_sort_by_column' );
function caag_rental_sort_by_column( $query )
{
	if ( ! is_admin() )
		return;
	if($query->query['post_type'] == CAAG_RENTAL_CUSTOM_POST_TYPE){
		if($query->query['orderby'] == CAAG_RENTAL_NAME_COLUMN){
			$query->set('meta_key', CAAG_RENTAL_CAAG_ID );
			$query->set('orderby', 'meta_value_num' );
		}elseif($query->query['orderby'] == CAAG_RENTAL_NAME_COLUMN){
			$query->set('orderby','title');
		}
	}
}
