<?php

class View {

    protected $viewData = array();
            
    function __construct() {
Debug::addMsg('View geladen');
    }
    
    // ruft eine Layout-Datei auf und bindet darin ein TemplateView ein - Standardmäßig wird index eingebunden
    public function render($template, $templateView, $viewFile = 'index'){
        // $template bestimmt welcher Template-Ordner aufgerufen werden soll und $templateView ist die Template-Datei
        $templateView = VIEW_PATH . DIRECTORY_SEPARATOR . $templateView . DIRECTORY_SEPARATOR . $viewFile . '.php';
        require VIEW_PATH . DIRECTORY_SEPARATOR . $template . '.tpl.php';
    }
    
    public function setViewData($key, $data){
        $this->viewData[$key] = $data;
    }
    
    public function getViewData($key = false){
        if($key === false){
            return $this->viewData;
        }else{
            return $this->viewData[$key];
        }
        
    }

}