<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
// defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'home'.DS.'kazibauc'.DS.'public_html');
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'kazibau-web');
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', SITE_ROOT.DS.'config');
defined('MODELS_PATH') ? null : define('MODELS_PATH', SITE_ROOT.DS.'models');
// defined('VENDOR_PATH') ? null : define('VENDOR_PATH', SITE_ROOT.DS.'vendor');

// db connections
require_once(CONFIG_PATH.DS.'database.php');

// // load mail()
// require_once(VENDOR_PATH.DS.'autoload.php');

// load all system functions
require_once(MODELS_PATH.DS.'functions.php');

// load sessions 
require_once(MODELS_PATH.DS.'sessions.php');

// load user type
require_once(MODELS_PATH.DS.'user_type.php');

// load users
require_once(MODELS_PATH.DS.'users.php');

// load categories
require_once(MODELS_PATH.DS.'categories.php');

// load categories
require_once(MODELS_PATH.DS.'categories.php');

// load categories
require_once(MODELS_PATH.DS.'brands.php');

// load products
require_once(MODELS_PATH.DS.'products.php');

// load product images
require_once(MODELS_PATH.DS.'product_images.php');