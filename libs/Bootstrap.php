<?php

class Bootstrap {

    protected $controller;
    protected $method;
    protected $params;
            
    function __construct() {
        // Eine Session starten, damit sie überall verfügbar ist
        Session::init();
        Url::parseUrl();
        
        Debug::addMsg('REDIRECT_URL: ' . $_SERVER['REDIRECT_URL']);
        Debug::addMsg('QUERY_STRING: ' . $_SERVER['QUERY_STRING']);
        Debug::addMsg('REQUEST_URI: ' . $_SERVER['REQUEST_URI']);
        
        if(empty(Url::getController())){
            Url::setController('index');
        }

        Debug::addMsg('Controller: ' . Url::getController());
        Debug::addMsg('Methode: ' . Url::getMethod());

        // Prüfen ob es den Controller gibt
        if (!file_exists(CONTROLLER_PATH . DIRECTORY_SEPARATOR . Url::getController('uc') . '.php')) {
            Url::setController('error');
            Url::setMethod('error404');
        }
        
        $controllerName = Url::getController('uc');
        require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . $controllerName . '.php';
        $controller = new $controllerName;
        $controller->loadModel(Url::getController());
        $controller->setTemplateView(Url::getController());
        
        if (Url::getMethod() && !empty(Url::getMethod())) {
            // Prüfen ob der Controller eine entsprechende Methode besitzt
            if (method_exists($controller, Url::getMethod('lcc'))) {
                if (!empty(Url::getParams())) {
                    // Methode des Controllers durch variable bzw. dynamische Variable mit Parameter ausführen
                    $controller->{Url::getMethod('lcc')}(Url::getParams());
                }else{
                    // Methode des Controllers durch variable bzw. dynamische Variable ohne Parameter ausführen 
                    $controller->{Url::getMethod('lcc')}();
                }
            }
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
        $controller->index();
        Url::setLastPage();
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
//    }
    
}