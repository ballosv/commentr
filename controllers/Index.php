<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        Debug::addMsg('index Controller');
        
    }
    
    public function index(){
        $this->view->setViewData('themes', $this->model->getCurrentThemes());
        $this->renderView();
    }
    

}