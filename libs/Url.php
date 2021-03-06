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
                $output .= ucfirst($val);
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
                $output .= ucfirst($val);
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
                    $output .= ucfirst($val);
                }
                $params[] = $output;
            }
            
            return $params;
        }
    }
    
    public function setSubParams($subParams){
        // SubParams setzen
        $GLOBALS['sub_params'] = $subParams;
    }
    
    public function getSubParams($format = false){
        if(!empty($GLOBALS['sub_params'])){
            if($format === false){
                return $GLOBALS['sub_params'];
            }elseif($format === 'print'){
                $output = '?';
                foreach ($GLOBALS['sub_params'] as $key => $val){
                    $output .= $key . '=' . $val . '&';
                }
                $output = rtrim($output, '&');

                return $output;
            }
        }else{
            return false;
        }
    }
    
    public static function printUrl($format = false){
        if(!empty(self::getParams())){
            
            foreach (self::getParams() as $param){
                $params .= '/' . $param;
            }
            $params .= self::getSubParams('print');
        }
        
        if($format === true){
            return DIRECTORY_SEPARATOR . self::getController() . DIRECTORY_SEPARATOR . self::getMethod() . $params;
        }
        
        return BASE_URL . DIRECTORY_SEPARATOR . self::getController() . DIRECTORY_SEPARATOR . self::getMethod() . $params;
    }
    
    public function urlParser(){
        $get = array();
        foreach ($_GET as $key => $val){
            $get[$key] = filter_input(INPUT_GET, $key);
        }
        
        $url = $get['url'];
        // URL verarbeitung
        unset($get['url']);
        
        
        
        
    }
    
    public static function parseUrl(){
//        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING);
//        $pgn = filter_input(INPUT_GET, 'pgn', FILTER_SANITIZE_STRING);
//        $ldc = filter_input(INPUT_GET, 'ldc', FILTER_SANITIZE_STRING);
//        $com = filter_input(INPUT_GET, 'com', FILTER_SANITIZE_STRING);
//        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        
        $get = array();
        foreach ($_GET as $key => $val){
            $get[$key] = filter_input(INPUT_GET, $key);
        }
        
        $url = $get['url'];
        unset($get['url']);
        
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
            
            $url = array_values($url);
            foreach ($url as $val){
                $params[] = $val;
            }
            self::setParams($params);
            
            self::setSubParams($get);
            
//            $subParams;
//
//            if(!empty($pgn)){
//                $subParams['pgn'] = $pgn;
//            }
//            
//            if(!empty($ldc)){
//                $subParams['ldc'] = $ldc;
//            }
//            
//            if(!empty($com)){
//                $subParams['com'] = $com;
//            }
//            
//            if(!empty($id)){
//                $subParams['id'] = $id;
//            }
//            
//            self::setSubParams($subParams);
        }
    }
    
    public static function setRedirectPage($url = false){
        $url = ($url === false) ? self::printUrl(true) : $url;
        Session::set('redirect_page', $url);
    }
    
    public static function getRedirectPage($format = false){
        if($format === true){
            return Session::get('redirect_page');
        }
        
        return BASE_URL . Session::get('redirect_page');
    }
    
    public static function unsetRedirectPage(){
        Session::unsetKey('redirect_page');
    }
    
    public static function setLastPage($url = false){
        $url = ($url === false) ? self::printUrl(true) : $url;
        Session::set('last_page', $url);
    }
    
    public static function getLastPage($format = false){
        if($format === true){
            return Session::get('last_page');
        }
        
        return BASE_URL . Session::get('last_page');
    }
    
    public static function getParamsFromLastPage(){
        $url = ltrim(self::getLastPage(true), '/');
        $url = rtrim($url, '/');
        $parts = explode('/', $url);
        unset($parts[0]);
        unset($parts[1]);
        $parts = array_values($parts);
        
        return $parts;
    }
    
    public static function setTempUrl($name, $url){
        Session::set($name, $url);
    }
    
    public static function getTempUrl($name, $format = false){
        $tempUrl = Session::get($name);
        
        if($format === true){
            return $tempUrl;
        }
        
        return BASE_URL . $tempUrl;
        
    }
    
    public static function unsetTempUrl($name){
        Session::unsetKey($name);
    }

//    public static function setUrlInSession($key, $url){
//        Session::set($key, $url);
//    }
//    
//    public static function unsetUrlInSession($key){
//        unset(Session::get($key));
//    }

}