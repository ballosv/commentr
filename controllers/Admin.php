<?php

class Admin extends Controller {

    function __construct() {
        parent::__construct();
        Debug::addMsg('Admin-Controller geladen');
        
        if($this->loginStatus == false || $this->userRole !== 1){
            Session::destroy();
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
    
    public function index(){
        // In allen Views die Themen zur Verfügung stellen
        $this->view->setViewData('themes', $this->model->getAllThemes());
        
        $this->renderView();
    }
    
    public function newTheme(){
        Debug::addMsg('Eingabemaske für neues Thema anzeigen');
        $this->view->setViewData('categories', $this->model->getAllCategories());
        $this->setViewFile('new_theme');
    }
    
    public function newTopic(){
        Debug::addMsg('Eingabemaske für neuen Topic anzeigen');
//        $this->view->setViewData('categories', $this->model->getAllCategories());
        $this->setViewFile('new_topic');
    }
    
    public function createNewTheme(){
        $saveTheme = $this->model->createNewTheme();
        if($saveTheme === true){
            header('Location: ' . BASE_URL . '/admin');
        }
        else{
            header('Location: ' . BASE_URL . '/error/error-save-theme');
        }
    }
    
    public function createNewTopic(){
        Debug::addMsg('Neuer Topic soll gespeichert werden');
        $saveTopic = $this->model->createNewTopic();
//        if($saveTopic === true){
//            header('Location: ' . BASE_URL . '/admin');
//        }
//        else{
//            header('Location: ' . BASE_URL . '/error/error-save-Topic');
//        }
        
    }
    
    public function deactivateTheme($params){
        Debug::addMsg('Thema soll deaktiviert werden');
        $deactivateTheme = $this->model->deactivateTheme($params[0]);
        if($deactivateTheme === true){
            header('Location: ' . BASE_URL . '/admin');
        }
        else{
            header('Location: ' . BASE_URL . '/error/error-delete-theme');
        }
    }
    
    public function showTrash(){
        Debug::addMsg('Deaktivierte Themen sollen angezeigt werden');
        $this->view->setViewData('trash-themes', $this->model->getAllDeactivatedThemes());
        $this->setViewFile('trash');
    }
    
    public function activateTheme($params){
        Debug::addMsg('Thema soll deaktiviert werden');
        $activateTheme = $this->model->activateTheme($params[0]);
        if($activateTheme === true){
            header('Location: ' . BASE_URL . '/admin/show-trash');
        }
        else{
            header('Location: ' . BASE_URL . '/error/error-delete-theme');
        }
    }

}