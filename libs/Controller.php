<?php

class Controller {

    // Bekommt die View-Klasse
    protected $view;
    // Standard-Template-Datei
    protected $template = 'default';
    // Der View-Ordner
    protected $templateView;
    // Die View-Datei
    protected $viewFile = 'index';
    // model speichern
    protected $model;
    
    
    protected $userRole;
    protected $loginStatus;
            
    function __construct() {
Debug::addMsg('Base-Controller gestartet');
        
        // Instanz der View-Klasse erstellen
        $this->view = new View();
        
        // Loginstatus speichern
        $this->loginStatus = Session::get('login_status');
        $this->userRole = Session::get('user_role');
    }
    
    // Model einbinden, wenn eines vorhanden ist
    public function loadModel($modelName){
        $model = $modelName . '_Model';
        $modelPath = MODEL_PATH . DIRECTORY_SEPARATOR . $model . '.php';
        if(file_exists($modelPath)){
            require_once $modelPath;
            $this->model = new $model();
        }
    }
    
    // Methode ruft die Render-Methode im View auf und übergibt Template-Ordner und Datei
    protected function renderView(){
        $this->view->render($this->template, $this->templateView, $this->viewFile);
    }
    
    public function setTemplateView($templateView){
        $this->templateView = $templateView;
    }
    
    public function setViewFile($viewFile){
        $this->viewFile = $viewFile;
    }

}