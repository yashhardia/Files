<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('DS', '/');
define('DS_PATH', DIRECTORY_SEPARATOR);
define('FOLDERNAME', ltrim(str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']), "/") );
define('RESOURCES', 'assets');

$base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$base .= '://'.$_SERVER['HTTP_HOST'].DS . FOLDERNAME;

define('SITEURL2',rtrim($base, "/"));
define('SITEURL',$base);

define('AJAX_LOADER', 	'<div align="center"><img align="middle" src="assets/images/loader.gif"/></div>');

/* NORMAL CONSTANTS */
define('MENU','menu');
define('ITEM','item');
define('OFFER','offer');
define('MEDIA','media');
define('ADD','add');
define('EDIT','edit');
define('UPDATE','update');
define('PROCESS','process');
define('DELIVERED','delivered');
define('CANCELLED','cancelled');
define('ADDON','addon');

define('REFRESH','refresh');
define('ALLOWED_TYPES','gif|jpg|png|jpeg');
define('GRP_USER', 2);
define('ADMIN', 'admin');
define('ACTIVE_CLASS', 'active_class');
/* ACTIVE CLASS CONSTANTS */
define('ACTIVE_PAGES','pages');
define('ACTIVE_MENU','menu');
define('ACTIVE_ITEMS','items');
define('ACTIVE_USERS','users');
define('ACTIVE_CUSTOMERS','customers');
define('ACTIVE_CONCERNS','raise concern');
define('ACTIVE_OFFERS','offers');
define('ACTIVE_DASHBOARD','dashboard');
define('ACTIVE_LOCATION','location');
define('ACTIVE_MASTER_SETTINGS','master_settings');
define('ACTIVE_ORDERS','orders');
define('ACTIVE_GALLERY','gallery');
define('ACTIVE_LANGUAGES','languages');
define('ACTIVE_ADDONS','addons');
define('ACTIVE_OPTIONS','options');
define('ACTIVE_CONFIGURATIONS','configurations');
define('ACTIVE_INFOTAINMENT','infotaiment');
define('ACTIVE_REPORT','report');
define('ACTIVE_NOTIFICATIONS','notifications');
define('ACTIVE_LOYALITY_POINTS','loyality_points');
define('ACTIVE_COUPONS','coupons');
define('ACTIVE_INVENTORY','inventory');
define('ACTIVE_RATING','rating');
define('ACTIVE_Review','review');
define('ACTIVE_PROMOTION','promotion');
define('ACTIVE_TAX_MANAGEMENT','tax_management');
define('ACTIVE_ABOUT_US','about_us');
define('ACTIVE_TERMS_AND_CONDITION','terms_condition.php');
/* URL CONSTANTS */
define('URL_INDEX', "auth");
define('URL_LOGIN', "auth/login");
define('URL_LOGOUT', "auth/logout");
define('URL_PROFILE', "admin/profile");
define('URL_RESET_PASSWORD', "auth/reset_password");
define('URL_ADMIN_CHANGE_PASSWORD', "admin/change_password");
define('URL_ADMIN', "admin");
define('URL_ADMIN_MENU', "menu");
define('URL_ADD_MENU', "menu/add_menu");
define('URL_EDIT_MENU', "menu/edit_menu");
define('URL_DELETE_MENU', "menu/delete_menu");
define('URL_MENU_STATUSTOGGLE', "menu/statustoggle");
define('URL_MENU_AJAX_GET_DATA', SITEURL2."/menu/ajax_get_data");
define('URL_ITEM_AJAX_GET_DATA', SITEURL2."/items/ajax_get_data");
define('URL_ITEM_STATUSTOGGLE', "items/statustoggle");
define('URL_ADMIN_ITEMS', "items");
define('URL_ADD_ITEMS', "items/add_item");
define('URL_EDIT_ITEMS', "items/edit_item");
define('URL_DELETE_ITEMS', "items/delete_item");
define('URL_ADMIN_ADDONS', "addons");
define('URL_ADMIN_INFOTAINMENT', "infotainment/view_list");
define('URL_ADD_ADDON', "addons/add_addon");
define('URL_EDIT_ADDON', "addons/edit_addon");
define('URL_DELETE_ADDON', "addons/delete_addon");
define('URL_ADDON_AJAX_GET_DATA', SITEURL2."/addons/ajax_get_data");
define('URL_ADDON_STATUSTOGGLE', "addons/statustoggle");
define('URL_ADMIN_OPTIONS', "options");
define('URL_CREATE_CATEGORY', "infotainment/add_category");
define('URL_VIEW_CATEGORY', "infotainment/view_category");
define('URL_REPORT', "reports/show_reports");
define('URL_VIEW_CATEGORY', "infotainment/view_category");
define('URL_VIEW_LIST', "infotainment/view_list");
define('URL_ADD_MEDIA', "infotainment/add_media");
define('URL_ADD_OPTION', "options/add_option");
define('URL_CONFIGURATIONS', "configurations/add_configurations");
define('URL_EDIT_OPTION', "options/edit_option");
define('URL_DELETE_OPTION', "options/delete_option");
define('URL_OPTION_AJAX_GET_DATA', SITEURL2."/options/ajax_get_data");
define('URL_OPTION_STATUSTOGGLE', "options/statustoggle");
define('URL_ADMIN_OFFERS', "offers");
define('URL_CREATE_OFFER', "offers/create_offer");
define('URL_EDIT_OFFER', "offers/edit_offer");
define('URL_DELETE_OFFER', "offers/delete_offer");
define('URL_OFFER_DETAILS', "offers/offer_details");
define('URL_OFFER_AJAX_GET_DATA', SITEURL2."/offers/ajax_get_data");
define('URL_OFFER_STATUSTOGGLE', SITEURL2."/offers/statustoggle");
define('URL_SITE_INDEX', "templates/site/index");
define('URL_ADMIN_USERS', "admin/users");
define('URL_ADMIN_USER_DETAILS', "admin/user_details");
define('URL_CUSTOMERS', "customers");
define('URL_CUSTOMER_DETAILS', "customers/customer_details");
define('URL_CUSTOMER_AJAX_GET_DATA', SITEURL2."/customers/ajax_get_data");
define('URL_CUSTOMER_STATUSTOGGLE', "customers/statustoggle");
define('URL_CUSTOMER_DELETE', "customers/delete_record");
define('URL_PAGE', "pages/page/");
define('URL_CITIES', "locations/cities");
define('AJAX_CITIES_GET_DATA', SITEURL2."/locations/ajax_cities_get_data");
define('CITIES_STATUSTOGGLE', "locations/cities_statustogle");
define('CITIES_ADD', "locations/cities/Add/");
define('CITIES_EDIT', "cities/Edit/");
define('CITIES_DELETE', "cities/Delete/");
define('URL_STATES', "locations/states");
define('URL_EDIT_STATES', "locations/states/Edit");
define('URL_SERVICE_LOCATION_AJAX_GET_DATA', SITEURL2."/locations/ajax_get_service_location_data");
define('URL_SERVICE_LOCATION_STATUSTOGGLE', "locations/location_statustoggle");
define('URL_SERVICE_LOCATIONS', "locations/delivery_locations");
define('URL_EDIT_SERVICE_LOCATIONS', "locations/edit_delivery_location");
define('URL_ADD_SERVICE_LOCATIONS', "locations/add_delivery_locations");
define('URL_DELETE_SERVICE_LOCATIONS', "locations/delete_locations");
define('URL_SITE_SETTINGS', "settings/app_settings");
define('URL_EMAIL_SETTINGS', "settings/email_settings");
define('URL_CHANGE_LANGUAGE', "settings/change_language");
define('URL_ORDERS', "orders");
define('URL_VIEW_ORDERS', "orders/view_order");
define('URL_UPDATE_ORDERS', "orders/update_order");
define('URL_DELETE_ORDER_ITEM', "orders/delete_order_item");
define('URL_ORDERS_INDEX', "orders/index/");
define('URL_ORDER_AJAX_GET_DATA', SITEURL2."/orders/ajax_get_data");
define('URL_PAYPAL_SETTINGS', "settings/paypal_settings");
define('URL_PAYU_SETTINGS', "settings/payu_settings");
define('URL_EMAIL_TEMPLATE_SETTINGS', "settings/email_templates");
define('URL_SMS_GATEWAYS', "settings/sms_gateways");
define('URL_SMS_TEMPLATES', "settings/sms_templates");
define('URL_ADD_SMS_GATEWAY', "settings/add_sms_gateway");
define('URL_ADD_SMS_FIELDS', "settings/fieldaddedit");
define('URL_UPDATE_SMS_FIELD_VALUES', "settings/update_sms_field_values");
define('URL_MAKE_DEFAULT', "settings/makedefault");

define('URL_GALLERY', "gallery");
define('URL_ADD_GALLERY', "gallery/add_gallery");
define('URL_EDIT_GALLERY', "gallery/edit_gallery");
define('URL_DELETE_GALLERY', "gallery/delete_gallery");
define('URL_GALLERY_STATUSTOGGLE', "gallery/statustoggle");
define('URL_GALLERY_AJAX_GET_DATA', "gallery/ajax_get_data");
define('URL_LANGUAGES', "languages");
define('URL_DELETE_LANGUAGE', "languages/delete_language");
define('URL_LANGUAGES_AJAX_DATA', SITEURL2."/languages/ajax_get_languages_data");
define('URL_LANGUAGE_STATUSTOGGLE', "languages/statustoggle");
define('URL_PHRASES', "languages/phrases");
define('URL_PHRASE_AJAX_DATA', SITEURL2."/languages/ajax_phrase_data");
define('URL_ADMIN_ADD_LANG', "languages/add_edit_lang");
define('URL_ADMIN_ADD_PHRASE', "languages/add_edit_phrase");
define('URL_EDIT_WEB_PHRASES', "languages/update_web_phrases");
define('URL_EDIT_APP_PHRASE', "languages/update_app_phrases");
define('URL_CHANGE_PASSWORD', "admin/change_password");
define('URL_USER_STATUSTOGGLE', "admin/statustoggle");
define('URL_PUSH_NOTIFICATIONS', "settings/push_notifications");
define('URL_NOTIFICATIONS', "notifications");
define('URL_NEW_NOTIFICATIONS', "notifications/send_notification");

define('URL_DELETE_CUSTOMER', "customers/delete_record");
define('URL_EDIT_CUSTOMER', "customers/edit_customer");
define('URL_VIEW_CUSTOMER', "customers/view_details");
define('URL_SEND_MAIL', "customers/send_mail");
define('URL_POINTS_SETTINGS', "loyality_points/points_settings");
define('URL_USER_REWARD_POINTS', "loyality_points/user_reward_points");
define('URL_POINTS_LOGS', "loyality_points/point_slogs");
define('URL_NEW_COUPON', "coupons/create_coupon");
define('URL_EDIT_COUPON', "coupons/edit_coupon");
define('URL_COUPONS', "coupons");
define('URL_COUPONS_AJAX_GET_DATA', SITEURL2."/coupons/ajax_get_data");
define('URL_COUPONS_STATUSTOGGLE', "coupons/statustoggle");
define('URL_COUPONS_DELETE', "coupons/delete_coupon");
define('URL_CONCERNS', "concerns/save_concern");
define('URL_INVENTORY', "inventory");
define('URL_INVENTORYSHOW', "inventory/show_edit");
define('URL_FOOD_RATINGS', "rating");
define('URL_RESTAURANT_RATING',"rating/restaurant_rating");
define('URL_REVIEW', "review");
define('URL_PROMOTION', "promotion");
define('URL_INFOTAINMENT', "infotainment");
define('URL_TAX_MANAGEMENT', "tax_management");
define('URL_ABOUT_US', "about_us.php");
define('URL_TERMS_AND_CONDITION', "terms_condition.php");
define('URL_RATINGS','rating');
/* TABLE CONSTANTS */

define('DBPREFIX','dn_');
define('TBL_MENU','menu');
define('TBL_INFOTAINMENT','infotainment');
define('TBL_INFOTAINMENT_MEDIA','infotainment_media');
define('TBL_CATEGORIES','categories');
define('TBL_SUB_CATEGORIES','subcategories');
define('TBL_ITEMS','items');
define('TBL_GALLERY','gallery');
define('TBL_ITEM_REVIEW','item_review');
define('TBL_CURRENCY','currency');
define('TBL_LANGUAGES','languages');
define('TBL_PHRASES','phrases');
define('TBL_MULTI_LANG','multi_lang');
define('TBL_PAYPAL_SETTINGS','paypal_settings');
define('TBL_ORDERS','orders');
define('TBL_ORDER_PRODUCTS','order_products');
define('TBL_OFFERS','offers');
define('TBL_OFFER_PRODUCTS','offer_products');
define('TBL_OFFER_REVIEWS','offer_reviews');
define('TBL_USER_ADDRESS','user_address');
define('TBL_USERS','users');
define('TBL_USER_GROUPS','users_groups');
define('TBL_GROUPS','groups');
define('TBL_TABLE_BOOKINGS','table_bookings');
define('TBL_EMAIL_TEMPLATES','email_templates');
define('TBL_SMS_TEMPLATES','sms_templates');
define('TBL_SITE_SETTINGS','site_settings');
define('TBL_EMAIL_SETTINGS','email_settings');
define('TBL_SMS_GATEWAYS','sms_gate_ways');
define('TBL_SETTINGS_FIELDS','system_settings_fields');
define('TBL_STATES','pl_states');
define('TBL_CITIES','pl_cities');
define('TBL_PAGES','pages');
define('TBL_SERVICE_DELIVERED_LOCATIONS','service_provide_locations');
define('TBL_ADDONS','addons');
define('TBL_OPTIONS','options');
define('TBL_ITEM_OPTIONS','item_options');
define('TBL_ITEM_ADDONS','item_addons');
define('TBL_ORDER_ADDONS','order_addons');
define('TBL_NOTIFICATIONS','notifications');
define('TBL_LOYALITY_POINTS','loyality_points');
define('TBL_CUSTOMER_POINTS','customer_points');
define('TBL_USER_POINTS','user_points');
define('TBL_COUPONS','coupon_codes');
define('TBL_USER_COUPONS','user_coupons');
define('TBL_PAYU_SETTINGS','payu_settings');
define('TBL_CONCERN','concerns');
define('TBL_INVENTORY','inventory');
define('TBL_RATINGS','rating');
define('TBL_REVIEW','review');
define('TBL_TAX_MANAGEMENT','tax_management');
define('TBL_PROMOTION','promotion');
/*  IMAGES UPLOAD PATH */

define('IMG_MENU','uploads/menu_images/');
define('IMG_MENU_THUMB','uploads/menu_images/thumbs/');
define('IMG_ADDONS','uploads/addon_images/');
define('IMG_ADDONS_THUMB','uploads/addon_images/thumbs/');
define('IMG_ITEMS','uploads/item_images/');
define('IMG_ITEMS_THUMB','uploads/item_images/thumbs/');
define('IMG_OFFER','uploads/offer_images/');
define('IMG_INFOTAINMENT','uploads/media/');
define('IMG_SITE_LOGO','uploads/site_logo/');
define('IMG_DEFAULT','uploads/default_images/noimage.png');
define('IMG_MEDIA','uploads/media/');
define('IMG_MEDIA_THUMB','uploads/media/thumbnails');
define('IMG_GALLERY_IMAGES','uploads/gallery_images/');

/* TEMPLATE CONSTANTS */

define('TEMPLATE_ADMIN','templates/admin/admin_template');

/* PAGE CONSTANTS */
define('PAGE_DASHBOARD','admin/dashboard');
define('PAGE_USERS','admin/users/users');
define('PAGE_USER_DETAILS','admin/users/view_user_details');
define('PAGE_ADD_MENU','admin/menu/add_menu');
define('PAGE_EDIT_MENU','admin/menu/edit_menu');
define('PAGE_MENUS','admin/menu/menus');
define('PAGE_ADD_ITEM','admin/items/add_item');
define('PAGE_EDIT_ITEM','admin/items/edit_item');
define('PAGE_ITEMS','admin/items/items');
define('PAGE_ADD_ADDON','admin/addons/add_addon');
define('PAGE_EDIT_ADDON','admin/addons/edit_addon');
define('PAGE_ADDONS','admin/addons/addons');
define('PAGE_ADD_OPTION','admin/options/add_option');
define('PAGE_EDIT_OPTION','admin/options/edit_option');
define('PAGE_OPTIONS','admin/options/options');
define('PAGE_CREATE_OFFER','admin/offers/create_offer');
define('PAGE_EDIT_OFFER','admin/offers/edit_offer');
define('PAGE_OFFERS','admin/offers/offers');
define('PAGE_OFFER_DETAILS','admin/offers/offer_details');
define('PAGE_LIST_LANG','admin/languages/list_lang');
define('PAGE_LIST_PHRASES','admin/languages/list_phrases');
define('PAGE_ADD_LANG','admin/languages/add_language');
define('PAGE_WEB_PHRASE_LIST','admin/languages/web_phrase_list');
define('PAGE_APP_PHRASE_LIST','admin/languages/app_phrase_list');
define('PAGE_ADD_PHRASE','admin/languages/add_phrase');
define('PAGE_VIEW_GALLERY','admin/gallery/view_gallery');
define('PAGE_ADD_GALLERY','admin/gallery/add_gallery');
define('PAGE_EDIT_GALLERY','admin/gallery/edit_gallery');
define('PAGE_LOCATION_EXCEL','admin/location/excel_page');
define('PAGE_ADD_STATE','admin/location/states/add_state');
define('PAGE_STATES','admin/location/states/states');
define('PAGE_ADD_CITY','admin/location/cities/add_city');
define('PAGE_CITIES','admin/location/cities/cities');
define('PAGE_ADD_SERVICE_LOCATION','admin/location/service_provide_locations/add_location');
define('PAGE_SERVICE_LOCATION','admin/location/service_provide_locations/locations');
define('PAGE_ORDERS','admin/orders/orders');
define('PAGE_VIEW_ORDERS','admin/orders/view_order');
define('PAGE_PAGES','admin/pages/page');
define('PAGE_EDIT_EMAIL_TEMPLATE','admin/settings/edit_email_template');
define('PAGE_EDIT_SMS_TEMPLATE','admin/settings/edit_sms_template');
define('PAGE_EMAIL_TEMPLATES','admin/settings/email_templates');
define('PAGE_SMS_TEMPLATES','admin/settings/sms_templates');
define('PAGE_PAYPAL_SETTINGS','admin/settings/paypal_settings');
define('PAGE_EMAIL_SETTINGS','admin/settings/email_settings');
define('PAGE_SMS_GATEWAYS','admin/settings/sms_gateways');
define('PAGE_SITE_SETTINGS','admin/settings/site_settings');
define('PAGE_CHANGE_PASSWORD','admin/change_password');
define('PAGE_PROFILE','admin/profile');
define('PAGE_ADD_SMS_GATEWAY', "admin/settings/add_sms_gateway");
define('PAGE_ADD_SMS_FIELDS', "admin/settings/fieldaddedit");
define('PAGE_UPDATE_SMS_FIELD_VALUES', "admin/settings/sms_update_field_values");
define('PAGE_GCM_PUSH_NOTIFICATIONS', "admin/settings/gcm_push_notifications");
define('PAGE_LIST_NOTIFICATIONS', "admin/notifications/view_notifications");
define('PAGE_NEW_NOTIFICATION', "admin/notifications/new_notification");
define('IMG_INFOTAINMENT_THUMB','uploads/infotainment_images/thumbs/');
