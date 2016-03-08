<?php

class Bootstrap {

    protected $controller;
    protected $method;
    protected $params;
            
    function __construct() {
        // Eine Session starten, damit sie überall verfügbar ist
        Session::init();
        // Parameter auslesen
        $url = $this->parseUrl();
//        print_r($url);
        /*
         * Controller starten
         */
        // Controller aufrufen
        // Standard Controller verwenden, wenn keiner angegeben ist
        $url[0] = !empty($url[0]) ? $url[0] : 'index';

        Debug::addMsg('Controller: ' . $url[0]);
        Debug::addMsg('Methode: ' . $url[1]);

        // Prüfen ob es den Controller gibt
        if (file_exists(CONTROLLER_PATH . DIRECTORY_SEPARATOR . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
        }
        // Fehlercontroller verwenden, wenn es den angefragten Controller nicht gibt
        else {
            $this->controller = 'Error';
            $this->method = 'error404';
            unset($url[1]);
        }

        // Controllerklasse einbinden
        require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . $this->controller . '.php';
        // Instanz des Controllers erstellen
        $controller = new $this->controller;
        
        $controllerName = lcfirst($this->controller);
        // Model laden
        $controller->loadModel($controllerName);
        // TemplateView laden
        $controller->setTemplateView($controllerName);
                
        // Den Parameter aus dem Array löschen
        unset($url[0]);
        
        /*
         * Methode starten
         */
        // Prüfen ob es einen Parameter für eine Methode gibt
        if (isset($url[1]) && !empty($url[1])) {
            // Prüfen ob der Controller eine entsprechende Methode besitzt
            if (method_exists($controller, $url[1])) {
                // Methode speichern
                $this->method = $url[1];
//                $controller->{$url[1]}();
            }
        }

        // Wenn keine Methode definiert wurde, standardmäßig nur die index-Methode ausführen
        if($this->method !== NULL){
            // Den Parameter für die Methode aus dem Array löschen
            unset($url[1]);
            /*
             * Methode des Controllers ausführen
             */
            // Prüfen ob es noch Parameter gibt
            if (!empty($url)) {
                // Parameter speichern
                $this->params = array_values($url);

                // Methode des Controllers durch variable bzw. dynamische Variable mit Parameter ausführen
                $controller->{$this->method}($this->params);
            }else{
                // Methode des Controllers durch variable bzw. dynamische Variable ohne Parameter ausführen 
                $controller->{$this->method}();
            }
        }
        
        // Nachdem die Controller-Methode ausgeführt wurde, die index-Methode für die Anzeige ausführen
        $controller->index();        
    }

    protected function parseUrl(){
        // Prüfen ob ob URL-Parameter übergeben wurde
        if (filter_input(INPUT_GET, 'url')) {
            // Letztes Slash aus der URL entfernen
            $url = rtrim(filter_input(INPUT_GET, 'url'), '/');
            // URL in ein Array umwandeln
            $url = explode('/', $url);
            
            // Bindestriche in Parametern entfernen und in camelcase konvertieren
            for ($i = 0 ; $i < count($url) ; $i++){
                $param = explode('-', $url[$i]);
                $url[$i] = $param[0];
                unset($param[0]);
                foreach ($param as $val){
                    $url[$i] .= htmlentities(ucfirst($val));
                }
            }

            return $url;
        }
    }
    
}