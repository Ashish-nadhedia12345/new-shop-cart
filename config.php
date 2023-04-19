<?php
session_start();

define('SITE_FS_PATH', dirname(__FILE__));

define('SITE_WS_PATH', 'http://new-shop-cart.local');

define('PRODUCT_IMAGES_WS_PATH', SITE_WS_PATH . '/assets/image/product-image');

define('PRODUCT_IMAGES_FS_PATH', SITE_FS_PATH . '/assets/image/product-image');

spl_autoload_register(function ($class) {
   include SITE_FS_PATH . '/classes/' . $class . '.php';
});
