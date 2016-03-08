<?php
require_once 'config.php';

// Wird immer dann ausgeführt, wenn eine Klasse instantiiert werden soll, die noch nicht eingebunden wurde
function __autoload($classe) {
    $class = ucfirst($classe);
    $class = $class . '.php';
    
    if(file_exists(LIB_PATH . DIRECTORY_SEPARATOR . $class)) {
        require_once LIB_PATH . DIRECTORY_SEPARATOR . $class;
    }
}

$app = new Bootstrap();
