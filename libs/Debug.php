<?php

class Debug {
    
    public static function getTest(){
        return 'Debug Test';
    }
    
    public static function startDebug(){
        $GLOBALS['debug'] = array();
    }

    public static function addMsg($msg){
        $GLOBALS['debug'][] = $msg;
    }
    
    public static function getMsg(){
        return $GLOBALS['debug'];
    }
    
    public static function consoleOut(){
        $output = '';
        foreach ($GLOBALS['debug'] as $msg){
            $output .= '<p>' . $msg . '</p>';
        }
        
        return $output;
    }

}