<?php

class Dashboard extends Controller {
    
    function __construct() {
        parent::__construct();
        Debug::addMsg('Dashboard geladen');
        
        // Sicherstellen, dass diese Seite nur angezeigt wird, wenn der User eingeloggt ist.
//        if($loginStatus == false){
//            Session::destroy();
//            header('Location: ' . BASE_URL . '/login');
//            exit;
//        }
//        $this->template = $this->controllerName;
    }
    
    public function index(){
        $this->renderView();
    }
    
//    public function admin(){
//        if($this->loginStatus == false || $this->userRole !== 1){
//            Session::destroy();
//            header('Location: ' . BASE_URL . '/login');
//            exit;
//        }
//        
//        $this->view->setViewData($this->model->getAllThemes());
//        
//        $this->viewFile = 'admin';
//    }
//    
//    public function user(){
//        if($this->loginStatus == false || $this->userRole !== 0){
//            Session::destroy();
//            header('Location: ' . BASE_URL . '/login');
//            exit;
//        }
//        
//        $this->viewFile = 'user';
//    }
    
}

