<?php

class Session {

    public static function init(){
        Debug::addMsg('Session wurde gestartet');
        session_start();
    }
    
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }
    
    public static function get($key){
        return $_SESSION[$key];
    }
    
    public static function destroy(){
//        unset($_SESSION);
        session_destroy();
    }
    

}