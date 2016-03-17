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
define('BASE_URL', 'http://localhost:8888');
define('PUBLIC_URL', BASE_URL . DIRECTORY_SEPARATOR . 'public');
//define('MODEL_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'public');

// Datenbank
// https://dbadmin.hosteurope.de/phpmyadmin/login.php?phpMyAdmin=qfkcqe22ek5q9atomadi6ls3sdvjp38s
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
//define('DB_HOST', 'WP354.WEBPACK.HOSTEUROPE.DE');
define('DB_NAME', 'db10715138-commentr');
define('DB_USER', 'db10715138-comtr');
define('DB_PASS', 'T3mpP455w0rt');

define('FETCH_MODE', PDO::FETCH_ASSOC);

// Frontend Config
define('INITIAL_LOAD_COUNT', 5);
define('DEFAULT_LOAD_COUNT', 10);
define('DEFAULT_PERIOD', 259200);
