<?php

class Url {
    
    public static function setController($controller){
        $GLOBALS['controller'] = $controller;
    }
    
    public static function getController($format = false){
        if($format === false){
            return $GLOBALS['controller'];
        }elseif($format === 'uc'){
            return ucfirst($GLOBALS['controller']);
        }elseif($format === 'lcc'){
            $param = explode('-', $GLOBALS['controller']);
            $output = $param[0];
            unset($param[0]);
            foreach ($param as $val){
                $output .= htmlentities(ucfirst($val));
            }
            
            return $output;
        }
    }
    
    public static function setMethod($method){
        $GLOBALS['method'] = $method;
    }
    
    public static function getMethod($format = false){
        if($format === false){
            return $GLOBALS['method'];
        }elseif($format === 'uc'){
            return ucfirst($GLOBALS['method']);
        }elseif($format === 'lcc'){
            $param = explode('-', $GLOBALS['method']);
            $output = $param[0];
            unset($param[0]);
            foreach ($param as $val){
                $output .= htmlentities(ucfirst($val));
            }
            
            return $output;
        }
        
    }
    
    public static function setParams($params){
        $GLOBALS['params'] = $params;
    }
    
    public static function getParams($format = false){
        if($format === false){
            return $GLOBALS['params'];
        }elseif($format === 'uc'){
            return ucfirst($GLOBALS['params']);
        }elseif($format === 'lcc'){
            $params = array();
            for ($i = 0 ; $i < count($GLOBALS['params']) ; $i++){
                $param = explode('-', $GLOBALS['params'][$i]);
                $output = $param[0];
                unset($param[0]);
                foreach ($param as $val){
                    $output .= htmlentities(ucfirst($val));
                }
                $params[] = $output;
            }
            
            return $params;
        }
    }
    
    public static function getUrl(){
//        $params;
        
        if(!empty(self::getParams())){
            
            foreach (self::getParams('lc') as $param){
                $params .= '/' . $param;
            }
        }
        return BASE_URL . DIRECTORY_SEPARATOR . self::getController() . DIRECTORY_SEPARATOR . self::getMethod('lc') . $params;
    }
    
    public static function parseUrl(){
        $url = filter_input(INPUT_GET, 'url');
        // Prüfen ob ob URL-Parameter übergeben wurde
        if ($url) {
            // Letztes Slash aus der URL entfernen
            $url = rtrim($url, '/');
            // URL in ein Array umwandeln
            $url = explode('/', $url);
            // Bindestriche in Parametern entfernen und in camelcase konvertieren
//            for ($i = 0 ; $i < count($url) ; $i++){
//                $param = explode('-', $url[$i]);
//                $url[$i] = $param[0];
//                unset($param[0]);
//                foreach ($param as $val){
//                    $url[$i] .= htmlentities(ucfirst($val));
//                }
//            }

            self::setController($url[0]);
            unset($url[0]);
            self::setMethod($url[1]);
            unset($url[1]);
            self::setParams(array_values($url));
        }
    }

//    public static function setUrlInSession($key, $url){
//        Session::set($key, $url);
//    }
//    
//    public static function unsetUrlInSession($key){
//        unset(Session::get($key));
//    }

}