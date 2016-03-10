<?php

class Theme extends Controller {

    function __construct() {
        parent::__construct();
        Debug::addMsg('Theme-Controller wurde geladen');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function showTheme($param){
        $theme_id = $param[0];
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
        $redirectUrl = '/user/new-opinion/' . $theme_id;
        Url::setRedirectPage($redirectUrl);
        $themePage = '/theme/show-theme/' . $theme_id;
        Url::setTempUrl('theme_page', $themePage);
        
        $this->view->setViewData('theme', $this->model->getThemeById($theme_id));
        $subthemes = $this->model->getAllSubthemesByTheme($theme_id);
        $this->view->setViewData('subthemes', $subthemes);
        // Alle Meinungen der Subthemes auslesen und speichern
        $opinions = array();
        foreach ($subthemes as $subtheme){
            $opinions[$subtheme['id']] = $this->model->getOpinionsBySubtheme($subtheme['id']);
        }
        $this->view->setViewData('opinions', $opinions);
//        var_dump($opinions);
        $this->setViewFile('show_theme');
    }

}