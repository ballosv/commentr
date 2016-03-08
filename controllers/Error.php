<?php

class Error extends Controller{
            
    function __construct() {
        parent::__construct();
        Debug::addMsg('Fehler Controller');
    }
    
    public function index(){
        Debug::addMsg('index geladen');
        
        $this->renderView();
    }
    
    public function error404(){
        Debug::addMsg('Fehlerseite 404 geladen');
        $this->setViewFile('error404');
        $this->view->setViewData('Die angeforderte Seite konnte nicht gefunden werden.');
    }
    
    public function errorLogin(){
        $this->setViewFile('error_login');
        $this->view->setViewData('Beim Einloggen ist ein Fehler aufgetreten');
    }
    
    public function errorSaveTheme(){
        $this->setViewFile('error_save_theme');
        $this->view->setViewData('Beim Speichern des Themas ist ein Fehler aufgetreten');
    }
    
    public function errorSaveOpinion(){
        $this->setViewFile('error_save_opinion');
        $this->view->setViewData('error', 'Beim Speichern deiner Meinung ist ein Fehler aufgetreten');
    }

}