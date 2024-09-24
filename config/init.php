<?php

define("DEBUG", true);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/core');
define("HELPERS", ROOT . '/vendor/core/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'eshop');
define("PATH", 'http://eshop.loc');
define("ADMIN", 'http://eshop.loc/admin');
define("NO_IMAGE", '/public/uploads/no_image.jpg');

require_once ROOT . '/vendor/autoload.php';