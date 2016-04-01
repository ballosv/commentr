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
        
        // Hero-Theme laden - Das aktuelleste Top-Thema
        /*
         * Das Theme mit der meisten aktivität
         * Anzahl Aktivitäten in letzter Zeit
         * 
         * Es werden Punkte vergeben für:
         * Topics: 15
         * Meinungen: 10
         * Likes: 5
         * Kommentare: 1
         * 
         * Die Aktivitäten verlieren je länger sie her sind ihren Wert bis sie keine Punkte mehr bringen
         * 
         * Das Thema mit den meisten Punkten ist das Herotheme
         */
//        $themeId = $this->model->getThemeIdsByRelevance();
//        $heroTheme = $this->model->getThemeById($themeId['theme_id']);
//        $this->view->setViewData('hero_theme', $heroTheme);
        $topThemes = $this->model->getThemesByRelevance(5);
        $heroTheme = $topThemes[0];
        
        $this->view->setViewData('top_themes', $topThemes);
        $this->view->setViewData('hero_theme', $heroTheme);

        // Anzahl Themen auslesen
        $totalCount = $this->model->getTotalThemeCount()['total_count'];
        $this->view->setViewData('total_theme_count', $totalCount);
        
        // Anzahl zu ladender Themen auf Anzahl vorhandener Themen beschrenken
        $maxCount = $totalCount >= $maxCount ? $maxCount : $totalCount;
        
        $this->view->setViewData('themes', $this->model->getNewThemesByCount($minCount, $maxCount));
    }
    

}