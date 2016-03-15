<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
Debug::addMsg('index Controller');
        
    }
    
    public function index(){
//        $this->view->setViewData('themes', $this->model->getThemes(0, 5));
//        $this->view->setViewData('themes', $this->model->getCurrentThemes());
        $this->renderView();
    }
    
    public function loadThemes($params = array(0, INITIAL_LOAD_COUNT)){
        $minCount = $params[0];
        $maxCount = $params[1];
        $this->view->setViewData('themes', $this->model->getThemes($minCount, $maxCount));
    }
    

}