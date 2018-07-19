<?php




/*
 * Custom Post Names
 */
define('CAAG_HQ_RENTAL_CUSTOM_POST_TYPE','caag_hq_rental_forms');
define('CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS','caag_hq_rental_locs');
define('CAAG_HQ_RENTAL_CUSTOM_POST_RATES', 'caag_hq_rental_rates');
define('CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES', 'caag_hq_rental_vehs');
define('CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS','caag_hq_rental_seas');
define('CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES', 'caag_hq_rental_fea');


/*
 * Requiring Module Files
 */
require_once('caag-iframe-forms.php');
require_once('caag-locations-posts.php');
require_once('caag-rates-posts.php');
require_once('caag-vehicle-class-posts.php');
require_once('caag-seasons-posts.php');
require_once ('caag-class-features.php');