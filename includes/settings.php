<?php


function caag_hq_rental_settings_init()
{
	caag_hq_rental_settings_registration();
}



add_action('admin_menu','caag_hq_rental_settings_menu');
function caag_hq_rental_settings_menu()
{
	add_options_page(
		CAAG_HQ_RENTAL_SETTING_TITLE,
		CAAG_HQ_RENTAL_SETTING_MENU,
		'manage_options',
		CAAG_HQ_RENTAL_SLUG,
		'caag_hq_rental_settings_html'
	);
}

function caag_hq_rental_settings_html()
{
	caag_hq_rental_styles();
	$settings = get_caag_hq_rental_user_settings();
	$current_endpoint =caag_hq_rental_get_api_endpoint();
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
							<td> <input type="text" name="<?php echo CAAG_HQ_RENTAL_TENANT_TOKEN; ?>" size="70" value="<?php echo $settings[CAAG_HQ_RENTAL_TENANT_TOKEN]; ?>" id="title" spellcheck="true" autocomplete="off"></td>
						</tr>
						<tr>
							<th><label class="wp-heading-inline" id="title-prompt-text" for="title">User Token</label></th>
							<td><input type="text" name="<?php echo CAAG_HQ_RENTAL_USER_TOKEN; ?>" size="70" value="<?php echo $settings[CAAG_HQ_RENTAL_USER_TOKEN]; ?>" id="title" spellcheck="true" autocomplete="off"></td>
						</tr>
                        <tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Select Date Format</label></th>
                            <td>
                                <?php if(get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == "YYYY-MM-DD"): ?>
                                    <select name="<?php echo CAAG_HQ_RENTAL_DATE_FORMAT; ?>">
                                        <option value="YYYY-MM-DD" selected="selected">YYYY-MM-DD</option>
                                        <option value="DD-MM-YYYY">DD-MM-YYYY</option>
                                    </select>
                                <?php elseif(get_option(CAAG_HQ_RENTAL_DATE_FORMAT) == "DD-MM-YYYY"): ?>
                                    <select name="<?php echo CAAG_HQ_RENTAL_DATE_FORMAT; ?>">
                                        <option value="YYYY-MM-DD" selected="selected">YYYY-MM-DD</option>
                                        <option value="DD-MM-YYYY" selected="selected">DD-MM-YYYY</option>
                                    </select>
                                <?php endif; ?>
                            </td>
                        </tr>
						<tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Select Api Region</label></th>
                            <td>
                                <select name="<?php echo CAAG_HQ_RENTAL_API_END_POINT; ?>">
                                    <option value="https://api.caagcrm.com/api/" <?php echo ($current_endpoint == 'https://api.caagcrm.com/api/') ? 'selected="selected"' : ''; ?>>America</option>
                                    <option value="https://api-europe.caagcrm.com/api-europe/" <?php echo ($current_endpoint == 'https://api-europe.caagcrm.com/api-europe/') ? 'selected="selected"' : ''; ?>>Europe</option>
                                    <option value="https://api-asia.caagcrm.com/api-asia/" <?php echo ($current_endpoint == 'https://api-asia.caagcrm.com/api-asia/') ? 'selected="selected"' : ''; ?>>Asia</option>
                                </select>
                            </td>
                        </tr>
						</tbody>
					</table>
					<?php wp_nonce_field( CAAG_HQ_RENTAL_NONCE, 'caag_nonce' ); ?>
					<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save">
				</form>
			</div>
		</div>
		<?php
		if(!empty($_POST) and wp_verify_nonce($_POST['caag_nonce'], CAAG_HQ_RENTAL_NONCE)){
			caag_hq_rental_save_settings($_POST);
			if(caag_hq_rental_check_settings_save($_POST)){
				$success = __('Settings were successfully saved!');
			}else{
				$error = __('It was an Error Proccessing the Information. Please Try Again!!!');
			};
		}		?>
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
function caag_hq_rental_settings_registration()
{
    if(! get_option(CAAG_HQ_RENTAL_USER_TOKEN)){
        add_option(CAAG_HQ_RENTAL_USER_TOKEN,'');
    }
    if(! get_option(CAAG_HQ_RENTAL_TENANT_TOKEN)){
        add_option(CAAG_HQ_RENTAL_TENANT_TOKEN,'');
    }
    if(! get_option(CAAG_HQ_RENTAL_DATE_FORMAT)){
        add_option(CAAG_HQ_RENTAL_DATE_FORMAT,'YYYY-MM-DD');
    }
    if(! get_option(CAAG_HQ_RENTAL_API_END_POINT)){
        add_option(CAAG_HQ_RENTAL_API_END_POINT,'https://api.caagcrm.com/api/fleets/brands');
    }
    if(! get_option(CAAG_HQ_RENTAL_API_END_POINT)){
        add_option(CAAG_HQ_RENTAL_API_END_POINT,'https://api.caagcrm.com/api/fleets/brands');
    }
}

/*
 * Save Caag Rental Settings Options
 * @param Array
 * @return void
 */
function caag_hq_rental_save_settings($settings)
{
	update_option(CAAG_HQ_RENTAL_USER_TOKEN, $settings[CAAG_HQ_RENTAL_USER_TOKEN]);
	update_option(CAAG_HQ_RENTAL_TENANT_TOKEN, $settings[CAAG_HQ_RENTAL_TENANT_TOKEN]);
    update_option(CAAG_HQ_RENTAL_DATE_FORMAT, $settings[CAAG_HQ_RENTAL_DATE_FORMAT]);
    update_option(CAAG_HQ_RENTAL_API_END_POINT, $settings[CAAG_HQ_RENTAL_API_END_POINT]);
}

/*
 * Checks if the Option were properly saved
 * @param Array
 * @return bool
 */
function caag_hq_rental_check_settings_save($settings)
{
	return (get_option(CAAG_HQ_RENTAL_TENANT_TOKEN) == $settings[CAAG_HQ_RENTAL_TENANT_TOKEN]) and (get_option(CAAG_HQ_RENTAL_USER_TOKEN) == $settings[CAAG_HQ_RENTAL_USER_TOKEN]);
}