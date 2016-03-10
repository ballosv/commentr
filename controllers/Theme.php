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
        Session::set('next_page', '/user/new-opinion/' . $theme_id);
        Session::set('theme_page', '/theme/show-theme/' . $theme_id);
        
        $this->view->setViewData('theme', $this->model->getThemeById($theme_id));
        $subthemes = $this->model->getAllSubthemesByTheme($theme_id);
        $this->view->setViewData('subthemes', $subthemes);
        // Alle Meinungen der Subthemes auslesen und speichern
        $options = array();
        foreach ($subthemes as $subtheme){
            $options[$subtheme['id']] = $this->model->getOpinionsBySubtheme($subtheme['id']);
        }
        
//        var_dump($options);
        
        $this->view->setViewData('opinions', $options);
        $this->setViewFile('show_theme');
    }

}