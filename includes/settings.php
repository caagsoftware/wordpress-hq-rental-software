<?php
/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 9/12/2017
 * Time: 9:29 PM
 */

function caag_rental_settings_init()
{
	caag_rental_settings_registration();
}



add_action('admin_menu','caag_rental_settings_menu');
function caag_rental_settings_menu()
{
	add_options_page(
		CAAG_RENTAL_SETTING_TITLE,
		CAAG_RENTAL_SETTING_MENU,
		'manage_options',
		CAAG_RENTAL_SLUG,
		'caag_rental_settings_html'
	);
}

function caag_rental_settings_html()
{
	caag_rental_styles();
	$settings = get_caag_rental_user_settings();
	?>
	<?php if(isset($success)): ?>
		<div class="message updated"><p><?php echo $success; ?></p></div>
	<?php endif; ?>
		<div class="wrap">
			<div id="wrap">
				<h1>Caag Software Authentication Access</h1>
				<div class="caag-notice-wp notice caag-notice">
					<p>Don't have an account yet? Create a new account by clicking on this link</p>
					<a href="https://caagsoftware.com/" class="caag-button caag-button-primary caag-button-external-link" target="_blank">Register Now</a>
				</div>
				<form action="" method="post">
					<table class="form-table">
						<tbody>
						<tr>
							<th><label class="wp-heading-inline" id="title" for="title">Tenant Token</label></th>
							<td> <input type="text" name="<?php echo CAAG_RENTAL_TENANT_TOKEN; ?>" size="70" value="<?php echo $settings[CAAG_RENTAL_TENANT_TOKEN]; ?>" id="title" spellcheck="true" autocomplete="off"></td>
						</tr>
						<tr>
							<th><label class="wp-heading-inline" id="title-prompt-text" for="title">User Token</label></th>
							<td><input type="text" name="<?php echo CAAG_RENTAL_USER_TOKEN; ?>" size="70" value="<?php echo $settings[CAAG_RENTAL_USER_TOKEN]; ?>" id="title" spellcheck="true" autocomplete="off"></td>
						</tr>
						</tbody>
					</table>
					<?php wp_nonce_field( CAAG_RENTAL_NONCE, 'caag_nonce' ); ?>
					<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save">
				</form>
			</div>
		</div>
		<?php

		if(!empty($_POST) and wp_verify_nonce($_POST['caag_nonce'], CAAG_RENTAL_NONCE)){
			caag_rental_save_settings($_POST);
			if(caag_rental_check_settings_save($_POST)){
				$success = __('Settings were successfully saved!');
			}else{
				$error = __('It was an Error Proccessing the Information. Please Try Again!!!');
			};
		}
		?>
		<?php if(isset($success)): ?>
			<div class="message updated"><p><?php echo $success; ?></p></div>
		<script>
			document.getElementById("wrap").remove();
		</script>
		<?php endif; ?>
			<?php if(isset($error)): ?>
			<div class="message updated"><p><?php echo $error; ?></p>
			</div>
		<?php endif; ?>
		<?php
}


/*
 * Add Caag Rental Options
 * @return void
 */
function caag_rental_settings_registration()
{
	add_option(CAAG_RENTAL_USER_TOKEN,'');
	add_option(CAAG_RENTAL_TENANT_TOKEN,'');
}

/*
 * Save Caag Rental Settings Options
 * @param Array
 * @return void
 */
function caag_rental_save_settings($settings)
{
	update_option(CAAG_RENTAL_USER_TOKEN, $settings[CAAG_RENTAL_USER_TOKEN]);
	update_option(CAAG_RENTAL_TENANT_TOKEN, $settings[CAAG_RENTAL_TENANT_TOKEN]);
}

/*
 * Checks if the Option were properly saved
 * @param Array
 * @return bool
 */
function caag_rental_check_settings_save($settings)
{
	return (get_option(CAAG_RENTAL_TENANT_TOKEN) == $settings[CAAG_RENTAL_TENANT_TOKEN]) and (get_option(CAAG_RENTAL_USER_TOKEN) == $settings[CAAG_RENTAL_USER_TOKEN]);
}