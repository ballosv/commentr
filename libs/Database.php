<?php

class Database extends PDO {

    function __construct() {
//        parent::__construct('mysql:host=localhost;dbname=lernordner_oop_mvc;charset=utf8', 'user_db_oop_mvc', 'temppass');
        parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
Debug::addMsg('Datenbank wurde geladen');
        
    }

}