<?php

/*
 * Form Index Page
 * @param WpQuery
 * @return void
 */
add_action('pre_get_posts', 'caag_hq_rental_form_index');
function caag_hq_rental_form_index($query)
{
	if(isset($query->query['post_type']) and  $query->query['post_type'] == CAAG_HQ_RENTAL_CUSTOM_POST_TYPE) {
		$tenant = get_caag_hq_rental_tenant_token();
		$user = get_caag_hq_rental_user_token();
		$final_token = base64_encode($tenant . ':' . $user);
		$args = array(
		    'headers' => array(
		        'Authorization' => 'Basic ' . $final_token
		    )
		);
		$api = wp_remote_get( CAAG_HQ_RENTAL_API_GET_CALLS, $args);
		$api_body = json_decode($api['body']);
		try{
			if ( !is_wp_error( $api ) and is_array( $api ) ) {
				$brands = json_decode($api['body'])->fleets_brands;
				foreach ( $brands as $form ) {
					if ( ! caag_hq_rental_exists( $form->id ) ) {
						$args = array(
							'post_title'  => $form->name,
							'post_status' => 'publish',
							'post_type'   => CAAG_HQ_RENTAL_CUSTOM_POST_TYPE
						);
						$post_id = wp_insert_post( $args, true );
						add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_CAAG_ID, (int)$form->id );
						add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_LINK, esc_url_raw($form->public_reservations_link_full) );
						add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_SHORTCODE, '[hq_rental_reservation_form id=' . $form->id . ']' );
						add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK, esc_url_raw($form->public_reservations_link_first_step) );
						if( isset($form->public_packages_link_full) and $form->public_packages_link_full != ''){
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_PUBLIC_PACKAGES_LINK, esc_url_raw($form->public_packages_link_full) );
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK_PACKAGES, esc_url_raw($form->public_packages_link_first_step) );
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_SHORTCODE_PACKAGES, '[hq_rental_forms_packages id=' . $form->id . ']' );
						}
						if( isset($form->public_reservations_packages_link_first_step) and $form->public_reservations_packages_link_first_step != '' ){
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK, esc_url_raw($form->public_reservations_packages_link_first_step) );
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES, '[hq_rental_forms_reservation_packages id=' . $form->id . ']' );
						}
						if( isset($form->my_reservations_link) and $form->my_reservations_link != ''){
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_MY_RESERVATION_LINK, esc_url_raw($form->my_reservations_link) );
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION, '[hq_rental_forms_my_reservations id=' . $form->id . ']' );
						}
						if( isset($form->my_package_reservations_link) and $form->my_package_reservations_link != ''){
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_MY_PACKAGE_RESERVATION_LINK, esc_url_raw($form->my_package_reservations_link) );
							add_post_meta( (int)$post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION, '[hq_rental_forms_my_package_reservation id=' . $form->id . ']' );
						}
					} else {
						$post = get_caag_hq_rental_by_meta( $form->id )[0];
						update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_LINK, esc_url_raw($form->public_reservations_link_full) );
						update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK, esc_url_raw($form->public_reservations_link_first_step) );
						update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_SHORTCODE, '[hq_rental_reservation_form id=' . $form->id . ']' );
						if( isset($form->public_packages_link_full) and $form->public_packages_link_full != '' ){
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_PUBLIC_PACKAGES_LINK, esc_url_raw($form->public_packages_link_full) );
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_FIRST_STEP_LINK_PACKAGES, esc_url_raw($form->public_packages_link_first_step) );
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_SHORTCODE_PACKAGES, '[hq_rental_forms_packages id=' . $form->id . ']' );
						}
						if( isset($form->public_reservations_packages_link_first_step) and $form->public_reservations_packages_link_first_step != ''){
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_PUBLIC_RESERVATION_PACKAGES_LINK, esc_url_raw($form->public_reservations_packages_link_first_step) );
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES, '[hq_rental_forms_reservation_packages id=' . $form->id . ']' );
						}
						if( isset($form->my_reservations_link) and $form->my_reservations_link != ''){
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_MY_RESERVATION_LINK, esc_url_raw($form->my_reservations_link) );
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION, '[hq_rental_forms_my_reservations id=' . $form->id . ']' );
						}
						if( isset($form->my_package_reservations_link) and $form->my_package_reservations_link != ''){
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_MY_PACKAGE_RESERVATION_LINK, esc_url_raw($form->my_package_reservations_link) );
							update_post_meta( (int)$post->post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION, '[hq_rental_forms_my_package_reservation id=' . $form->id . ']' );
						}
						$args    = array(
							'ID'    => (int)$post->post_id,
							'title' => $form->name
						);
						wp_update_post( $args );
					}
				}
			} else {
			    if( is_wp_error($api) ){
                    echo '<div class="notice notice-error"><p>'. $api->get_error_message() .'</p></div>';
                }else if( empty($api) ){
                    echo '<div class="notice notice-error"><p>Please Check your Caag Credentials</p></div>';
                }else if( $api_body->status_code == 401 or $api_body->status_code == 500 ){
                    echo '<div class="notice notice-error"><p>'. $api_body->message .'</p></div>';
                }else {
                    echo '<div class="notice notice-error"><p>Something went Wrong!!!</p></div>';
                }
			}
		} catch (Exception $e){
			echo '<div class="notice notice-error"><p>Please Check your Caag Credentials</p></div>';
		}
	}
}

/*
 * Add Meta Data columns to Post Table: Link
 * Only Header and Footer
 */
add_filter('manage_' . CAAG_HQ_RENTAL_CUSTOM_POST_TYPE . '_posts_columns', 'caag_hq_rental_add_meta_columns');
function caag_hq_rental_add_meta_columns($defaults)
{
	$columns[CAAG_HQ_RENTAL_ID_COLUMN] = CAAG_HQ_RENTAL_ID_COLUMN;
	$columns[CAAG_HQ_RENTAL_NAME_COLUMN] = CAAG_HQ_RENTAL_NAME_COLUMN;
	$columns[CAAG_HQ_RENTAL_SHORTCODE_COLUMN] = CAAG_HQ_RENTAL_SHORTCODE_COLUMN;
	$columns[CAAG_HQ_RENTAL_SHORTCODE_PACKAGES_COLUMN] = CAAG_HQ_RENTAL_SHORTCODE_PACKAGES_COLUMN;
	$columns[CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN] = CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN;
	$columns[CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION_COLUMN] = CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION_COLUMN;
	$columns[CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION_COLUMN] = CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION_COLUMN;
	return $columns;
}

/*
 * Displaying Actual Meta Data Values
 * return @void
 */
add_action('manage_posts_custom_column', 'caag_hq_rental_fill_meta_columns', 10, 2);
function caag_hq_rental_fill_meta_columns($column_name, $post_id)
{
	if ($column_name == CAAG_HQ_RENTAL_ID_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_CAAG_ID)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_CAAG_ID)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_HQ_RENTAL_NAME_COLUMN) {
		$post = get_post($post_id);
		echo $post->post_title;
	}
	if ($column_name == CAAG_HQ_RENTAL_SHORTCODE_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_HQ_RENTAL_SHORTCODE_PACKAGES_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_PACKAGES)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_PACKAGES)[0];
		}else{
			echo '';
		}
	}
	if ($column_name == CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_RESERVATION_PACKAGES)[0];
		}else{
			echo '';
		}
	}
	if($column_name == CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_RESERVATION)[0];
		}else{
			echo '';
		}
	}
	if($column_name == CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION_COLUMN) {
		if(isset(get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION)[0])){
			echo get_post_meta($post_id, CAAG_HQ_RENTAL_SHORTCODE_MY_PACKAGE_RESERVATION)[0];
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
add_filter('manage_edit-' . CAAG_HQ_RENTAL_CUSTOM_POST_TYPE . '_sortable_columns',
    'caag_hq_rental_all_sortable_columns');
function caag_hq_rental_all_sortable_columns($columns)
{
    $columns[CAAG_HQ_RENTAL_ID_COLUMN] = 'Identifier';
    $columns[CAAG_HQ_RENTAL_NAME_COLUMN] = 'Name';

    return $columns;
}

/*
 * Orders Columns By Id and Title in Admin Table
 * @param WpQuery
 * @return void
 */
add_action('pre_get_posts', 'caag_hq_rental_sort_by_column');
function caag_hq_rental_sort_by_column($query)
{
    if (!is_admin()) {
        return;
    }
    if ($query->query['post_type'] == CAAG_HQ_RENTAL_CUSTOM_POST_TYPE) {
        if ($query->query['orderby'] == CAAG_HQ_RENTAL_NAME_COLUMN) {
            $query->set('meta_key', CAAG_HQ_RENTAL_CAAG_ID);
            $query->set('orderby', 'meta_value_num');
        } elseif ($query->query['orderby'] == CAAG_HQ_RENTAL_NAME_COLUMN) {
            $query->set('orderby', 'title');
        }
    }
}

add_filter('query_vars', 'caag_hq_rental_add_query_vars');
function caag_hq_rental_add_query_vars($public_query_vars)
{
    $public_query_vars[] = 'pick_up_date';
    $public_query_vars[] = 'pick_up_time';
    $public_query_vars[] = 'return_date';
    $public_query_vars[] = 'return_time';
    $public_query_vars[] = 'some_unique_identifier_for_your_var';
    $public_query_vars[] = 'some_unique_identifier_for_your_var';

    return $public_query_vars;
}