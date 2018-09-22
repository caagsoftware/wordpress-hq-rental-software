<?php




/*
 * Custom Post Names
 */
define('CAAG_HQ_RENTAL_CUSTOM_POST_TYPE','caag_hq_rental_forms');
define('CAAG_HQ_RENTAL_CUSTOM_POST_BRANDS', 'caag_hq_brand');
define('CAAG_HQ_RENTAL_CUSTOM_POST_LOCATIONS','caag_hq_rental_locs');
define('CAAG_HQ_RENTAL_CUSTOM_POST_RATES', 'caag_hq_rental_rates');
define('CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES', 'caag_hq_rental_vehs');
define('CAAG_HQ_RENTAL_CUSTOM_POST_SEASONS','caag_hq_rental_seas');
define('CAAG_HQ_RENTAL_CUSTOM_POST_FEATURES', 'caag_hq_rental_fea');
define('CAAG_HQ_RENTAL_CUSTOM_POST_ADDITIONAL_CHARGES', 'caag_hq_charges');
define('CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_IMAGES', 'caag_hq_veh_images');
define('CAAG_HQ_RENTAL_CUSTOM_POST_VEHICLE_CLASSES_DECREASING_RATES', 'caag_hq_veh_de_ra');


/*
 * Requiring Module Files
 */
require_once('caag-iframe-forms.php');
require_once('caag-brands-posts.php');
require_once('caag-locations-posts.php');
require_once('caag-rates-posts.php');
require_once('caag-vehicle-class-posts.php');
require_once('caag-seasons-posts.php');
require_once('caag-class-features.php');
require_once('caag-additional-charges.php');
require_once('caag-vehicle-classes-images.php');
require_once('caag-vehicle-class-decreasing-rates.php');