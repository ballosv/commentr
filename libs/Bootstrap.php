<?php

class Bootstrap {

    protected $controller;
    protected $method;
    protected $params;
           
    function __construct() {
        // Eine Session starten, damit sie überall verfügbar ist
        Session::init();
        Url::parseUrl();
        $this->controller = Url::getController();
        $this->method = Url::getMethod('lcc');
        $this->params = Url::getParams();
        
        Debug::addMsg('REDIRECT_URL: ' . $_SERVER['REDIRECT_URL']);
        Debug::addMsg('QUERY_STRING: ' . $_SERVER['QUERY_STRING']);
        Debug::addMsg('REQUEST_URI: ' . $_SERVER['REQUEST_URI']);
        
        // Wenn kein Controller übergeben wurde auf Standard-Controller schalten
        if(empty($this->controller)){
            $this->controller = 'index';
        }
        
        Debug::addMsg('Controller: ' . Url::getController());
        Debug::addMsg('Methode: ' . Url::getMethod());
        Debug::addMsg('Parameter-1: ' . Url::getParams()[0]);
        Debug::addMsg('Parameter-2: ' . Url::getParams()[1]);
        
        // Prüfen ob es den Controller gibt
        if (!file_exists(CONTROLLER_PATH . DIRECTORY_SEPARATOR . ucfirst($this->controller) . '.php')) {
            $this->controller = 'error';
            $this->method = 'error404';
        }
        
        $controllerName = ucfirst($this->controller);
        require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . $controllerName . '.php';
        $controller = new $controllerName;
        $controller->loadModel($controllerName);
        $controller->setTemplateView($this->controller);  
        
        if ($this->method && !empty($this->method)) {
            // Prüfen ob der Controller eine entsprechende Methode besitzt
            if (method_exists($controller, $this->method)) {
                if (!empty($this->params)) {
                    // Methode des Controllers durch variable bzw. dynamische Variable mit Parameter ausführen
                    $controller->{$this->method}($this->params);
                }else{
                    // Methode des Controllers durch variable bzw. dynamische Variable ohne Parameter ausführen 
                    $controller->{$this->method}();
                }
            }
        }
        
        $controller->index();
        if(Url::getController() !== 'login'){
            Url::setLastPage();
        }
        
        // Parameter auslesen
//        $url = $this->parseUrl();
        
        /*
         * Controller starten
         */
        // Controller aufrufen
        // Standard Controller verwenden, wenn keiner angegeben ist
//        $url[0] = !empty($url[0]) ? $url[0] : 'index';
        
//        if (file_exists(CONTROLLER_PATH . DIRECTORY_SEPARATOR . ucfirst($url[0]) . '.php')) {
//            $this->controller = ucfirst($url[0]);
//        }
//        // Fehlercontroller verwenden, wenn es den angefragten Controller nicht gibt
//        else {
//            $this->controller = 'Error';
////            Url::setController('error');
//            $this->method = 'error404';
////            Url::setMethod('error404');
//            unset($url[1]);
//        }
//        // Controllerklasse einbinden
//        require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . $this->controller . '.php';
//        // Instanz des Controllers erstellen
//        $controller = new $this->controller;
//        
//        $controllerName = lcfirst($this->controller);
//        // Model laden
//        $controller->loadModel($controllerName);
//        // TemplateView laden
//        $controller->setTemplateView($controllerName);
//                
//        // Den Parameter aus dem Array löschen
//        unset($url[0]);
        
        /*
         * Methode starten
         */
        // Prüfen ob es einen Parameter für eine Methode gibt
//        if (isset($url[1]) && !empty($url[1])) {
//            // Prüfen ob der Controller eine entsprechende Methode besitzt
//            if (method_exists($controller, $url[1])) {
//                // Methode speichern
//                $this->method = $url[1];
////                Url::setMethod($url[1]);
////                $controller->{$url[1]}();
//            }
//        }
        

//        // Wenn keine Methode definiert wurde, standardmäßig nur die index-Methode ausführen
//        if($this->method !== NULL){
//            // Den Parameter für die Methode aus dem Array löschen
//            unset($url[1]);
//            /*
//             * Methode des Controllers ausführen
//             */
//            // Prüfen ob es noch Parameter gibt
//            if (!empty($url)) {
//                // Parameter speichern
//                $this->params = array_values($url);
////                Url::setParams(array_values($url));
//
//                // Methode des Controllers durch variable bzw. dynamische Variable mit Parameter ausführen
//                $controller->{$this->method}($this->params);
//            }else{
//                // Methode des Controllers durch variable bzw. dynamische Variable ohne Parameter ausführen 
//                $controller->{$this->method}();
//            }
//        }
//        echo Url::parseUrl();
        // Nachdem die Controller-Methode ausgeführt wurde, die index-Methode für die Anzeige ausführen
//        $controller->index();
    }

//    protected function parseUrl(){
//        // Prüfen ob ob URL-Parameter übergeben wurde
//        if (filter_input(INPUT_GET, 'url')) {
//            // Letztes Slash aus der URL entfernen
//            $url = rtrim(filter_input(INPUT_GET, 'url'), '/');
//            // URL in ein Array umwandeln
//            $url = explode('/', $url);
//            
//            // Bindestriche in Parametern entfernen und in camelcase konvertieren
//            for ($i = 0 ; $i < count($url) ; $i++){
//                $param = explode('-', $url[$i]);
//                $url[$i] = $param[0];
//                unset($param[0]);
//                foreach ($param as $val){
//                    $url[$i] .= htmlentities(ucfirst($val));
//                }
//            }
//
//            return $url;
//        }
//          return FALSE;
//    }

}