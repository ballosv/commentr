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
        
        // Anzahl Themen auslesen
        $totalCount = $this->model->getTotalThemeCount()['total_count'];
        $this->view->setViewData('total_theme_count', $totalCount);
        
        // Anzahl zu ladener Themen auf Anzahl vorhandener Themen beschrenken
        $maxCount = $totalCount >= $maxCount ? $maxCount : $totalCount;
        
        $this->view->setViewData('themes', $this->model->getThemesByCount($minCount, $maxCount));
    }
    

}