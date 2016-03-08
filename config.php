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
define('BASE_URL', 'http://localhost:8888/');
define('PUBLIC_URL', BASE_URL . DIRECTORY_SEPARATOR . 'public');
//define('MODEL_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'public');

// Datenbank
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'work_commentr_v01');
define('DB_USER', 'user_db_commentr');
define('DB_PASS', 'T3mpP455w0rtD4m1t3sN1chtG3kn4cktw1rd');
