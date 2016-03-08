<?php

class User extends Controller {

    function __construct() {
        parent::__construct();
        Debug::addMsg('User-Controller geladen');
        
        if($this->loginStatus == false || $this->userRole !== 0){
//            Session::destroy();
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function newOpinion($param){
        $this->view->setViewData('theme_id', $param[0]);
        $this->setViewFile('new_opinion');
    }
    
    public function createNewOpinion($param){
        header('Location: ' . BASE_URL);
//        $saveOpinion = $this->model->createNewOpinion($param[0]);
//        
//        if($saveOpinion === true){
//            header('Location: ' . BASE_URL . Session::get('theme_page'));
//        }else{
//            header('Location: ' . BASE_URL . '/error/error-save-opinion');
//        }
    }

}