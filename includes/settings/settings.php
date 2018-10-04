<?php

/*
 * Settings on Plugin Activations
 */
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
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Select Front-end Date Format</label></th>
                            <td>
                                <select name="<?php echo CAAG_HQ_RENTAL_DATE_FORMAT; ?>">
                                    <?php echo caag_hq_options_get_datetime_options(get_option(CAAG_HQ_RENTAL_DATE_FORMAT)); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Select System Date Format</label></th>
                            <td>
                                <select name="<?php echo CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM; ?>">
                                    <?php echo caag_hq_options_get_datetime_options(get_option(CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM)); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Use Frontend Date Format on System Backend</label></th>
                            <td>
                                <?php $custom_date_option = get_option(CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT); ?>
                                <?php if($custom_date_option == '0'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT; ?>" type="checkbox" id="thumbnail_crop" value="1">
                                <?php elseif($custom_date_option == '1'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT; ?>" type="checkbox" id="thumbnail_crop" value="1" checked="checked">
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
                        <tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Redirect Reservation Workflow on Safari Browser</label></th>
                            <td>
                                <?php $safari_option = get_option(CAAG_HQ_RENTAL_SAFARI_BROWSER); ?>
                                <?php if($safari_option == '0'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_SAFARI_BROWSER; ?>" type="checkbox" id="thumbnail_crop" value="1">
                                <?php elseif($safari_option == '1'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_SAFARI_BROWSER; ?>" type="checkbox" id="thumbnail_crop" value="1" checked="checked">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>

                                <label class="wp-heading-inline" id="title-prompt-text" for="title">Enable Woocommerce Product Syncronization</label>
                            </th>
                            <td>
                                <?php $woocommerce_option = get_option(CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION); ?>
                                <?php if($woocommerce_option == '0'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION; ?>" type="checkbox" id="thumbnail_crop" value="1">
                                <?php elseif($woocommerce_option == '1'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION; ?>" type="checkbox" id="thumbnail_crop" value="1" checked="checked">
                                <?php endif; ?>
                                <span class="hq-warning-woo">If this option is enabled, all Woocommerce products will be deleted</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Enable Tax Addition on Syncronization</label></th>
                            <td>
                                <?php $taxes_option = get_option(CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC); ?>
                                <?php if($taxes_option == '0'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC; ?>" type="checkbox" id="thumbnail_crop" value="1">
                                <?php elseif($taxes_option == '1'): ?>
                                    <input name="<?php echo CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC; ?>" type="checkbox" id="thumbnail_crop" value="1" checked="checked">
                                <?php endif; ?>

                            </td>
                        </tr>
						</tbody>
					</table>
					<?php wp_nonce_field( CAAG_HQ_RENTAL_NONCE, 'caag_nonce' ); ?>
					<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save">
				</form>
			</div>
            <div class="notice updated is-dismissible fw-brz-dismiss">
                <p style="font-size:14px; font-weight: bold;">
                    Safari & Opera Browser
                </p>
                <p style="text-align: justify;">
                    Due to an incompatibility with Safari and Opera browsers, the domain name of the iframe has to be updated.
                    You will need to add an A record in your DNS records where the value is the name of your tenant.

                </p>
                <p style="text-align: justify;">
                    For example if your link is rentals.caagcrm.com the value for the A record has to be “rentals” and the IP address will be dependent on your installation:
                </p>
                <ul>
                    <li>America: 45.79.176.147</li>
                    <li>Europe: 45.77.139.237</li>
                    <li>Asia: 139.162.35.27</li>
                </ul>
                <p style="text-align: justify;">
                       Once you have created the A record please create a support ticket inside the HQ application so our team can proceed with the installation.
                </p>
                <style>
                    .fw-brz-dismiss {
                        border-left-color: #d62c64 !important;
                    }
                    .fw-brz-dismiss p:last-of-type a {
                        color: #fff;
                        font-size: 13px;
                        line-height: 1;
                        background-color: #d62c64;
                        box-shadow: 0px 2px 0px 0px #981e46;
                        padding: 11px 27px 12px;
                        border: 1px solid #d62c64;
                        border-bottom: 0;
                        border-radius: 3px;
                        text-shadow: none;
                        height: auto;
                        text-decoration: none;
                        display:inline-block;
                        transition: all 200ms linear;
                    }
                    .fw-brz__btn-install:hover {
                        background-color: #141923;
                        color: #fff;
                        border-color: #141923;
                        box-shadow: 0px 2px 0px 0px #141923;
                    }
                    .hq-warning-woo{
                        font-weight: bold;
                        color: red;
                    }
                </style>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
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
        add_option(CAAG_HQ_RENTAL_DATE_FORMAT,'Y-m-d H:i');
    }
    if(! get_option(CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM)){
        add_option(CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM,'Y-m-d H:i');
    }
    if(! get_option(CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT)){
        add_option(CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT,'0');
    }
    if(! get_option(CAAG_HQ_RENTAL_API_END_POINT)){
        add_option(CAAG_HQ_RENTAL_API_END_POINT,'https://api.caagcrm.com/api/');
    }
    if(! get_option(CAAG_HQ_RENTAL_SAFARI_BROWSER)){
        add_option(CAAG_HQ_RENTAL_SAFARI_BROWSER,'0');
    }
    if(! get_option(CAAG_HQ_RENTAL_CURRENT_BRAND_SELECTED)){
        add_option(CAAG_HQ_RENTAL_CURRENT_BRAND_SELECTED,'0');
    }
    if( ! get_option(CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION) ){
        add_option( CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION, '0' );
    }
    if( ! get_option(CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC) ){
        add_option( CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC, '0' );
    }

}

/*
 * Save Caag Rental Settings Options
 * @param Array
 * @return void
 */
function caag_hq_rental_save_settings($settings)
{
    caag_hq_locations_cron_job();
	update_option(CAAG_HQ_RENTAL_USER_TOKEN, $settings[CAAG_HQ_RENTAL_USER_TOKEN]);
	update_option(CAAG_HQ_RENTAL_TENANT_TOKEN, $settings[CAAG_HQ_RENTAL_TENANT_TOKEN]);
    update_option(CAAG_HQ_RENTAL_DATE_FORMAT, $settings[CAAG_HQ_RENTAL_DATE_FORMAT]);
    update_option( CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM, $settings[CAAG_HQ_RENTAL_DATE_FORMAT_SYSTEM] );
    update_option(CAAG_HQ_RENTAL_API_END_POINT, $settings[CAAG_HQ_RENTAL_API_END_POINT]);
    if(isset($settings[CAAG_HQ_RENTAL_SAFARI_BROWSER])){
        if($settings[CAAG_HQ_RENTAL_SAFARI_BROWSER] == '1'){
            update_option(CAAG_HQ_RENTAL_SAFARI_BROWSER, '1');
        }
    }else{
        update_option(CAAG_HQ_RENTAL_SAFARI_BROWSER, '0');
    }
    if(isset($settings[CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION])){
        if($settings[CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION] == '1'){
            update_option(CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION, '1');
        }
    }else{
        update_option(CAAG_HQ_RENTAL_WOOCOMMERCE_SYNC_OPTION, '0');
    }

    /*
     * Custom System Dateformat Functionality
     */
    if(isset($settings[CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT])){
        if($settings[CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT] == '1'){
            update_option(CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT, '1');
        }
    }else{
        update_option(CAAG_HQ_RENTAL_USE_CUSTOM_DATE_FORMAT, '0');
    }
    if(isset($settings[CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC])){
        if($settings[CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC] == '1'){
            update_option(CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC, '1');
        }
    }else{
        update_option(CAAG_HQ_RENTAL_ADD_TAXES_TO_RATES_ON_API_SYNC, '0');
    }
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