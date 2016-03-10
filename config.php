<?php
// Debug-Mode
define('DEBUG_MODE', TRUE);

// Datei-Pfade
define('APP_PATH', realpath(dirname(__FILE__)));
define('LIB_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'libs');
define('CONTROLLER_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'controllers');
define('VIEW_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'views');
define('MODEL_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'models');

// URL-Pfade
// Standard Sven
//define('BASE_URL', 'http://localhost:8888');
// Standard Freddy
define('BASE_URL', 'http://localhost:81');

define('PUBLIC_URL', BASE_URL . DIRECTORY_SEPARATOR . 'public');
//define('MODEL_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'public');

// Datenbank
// https://dbadmin.hosteurope.de/phpmyadmin/login.php?phpMyAdmin=qfkcqe22ek5q9atomadi6ls3sdvjp38s
define('DB_TYPE', 'mysql');
define('DB_HOST', 'WP354.WEBPACK.HOSTEUROPE.DE');
define('DB_NAME', 'db10715138-commentr');
define('DB_USER', 'db10715138-comtr');
define('DB_PASS', 'T3mpP455w0rt');
