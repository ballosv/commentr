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
//        $theme_id = $param[0];
        $link = $param[0];
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
        $themePage = '/theme/show-theme/' . html_entity_decode($link);
        Url::setTempUrl('theme_page', $themePage);
        
//        $this->view->setViewData('theme', $this->model->getThemeById($theme_id));
        $theme = $this->model->getThemeByLink($link);
        $this->view->setViewData('theme', $theme);
        $subthemes = $this->model->getAllSubthemesByTheme($theme['id']);
        $this->view->setViewData('subthemes', $subthemes);

        // Funktioniert hier nicht, weil noch nicht bekannt ist, zu welchem Subtheme eine Meinung gespeichert werden soll
//        $redirectUrl = '/user/new-opinion/' . $theme['link'] . '/' . $link;
//        Url::setRedirectPage($redirectUrl);
        
        // Alle Meinungen, Kommentare und Likes bzw. Dislikes der Subthemes auslesen und speichern
        $opinions = array();
        $AllOpinionsWithComments = array();
        $commments = array();
        $likes = array();
        
        foreach ($subthemes as $subtheme){
            $opinions[$subtheme['id']] = $this->model->getOpinionsBySubtheme($subtheme['id']);
            foreach($opinions[$subtheme['id']] as $opinion){
                $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
                // Like nur speichern, wenn auch ein Datensatz vorhanden ist
                if($like !== FALSE){
                    $likes[$opinion['id']] = $like;
                }
            }
            
            $opinionsWidthComments = $this->model->getCommentedOpinionsBySubtheme($subtheme['id'], '');
            if($opinionsWidthComments !== NULL){
                $AllOpinionsWithComments[$subtheme['id']] = $opinionsWidthComments;
            }
            // Kommentare auslesen
            foreach ($AllOpinionsWithComments[$subtheme['id']] as $opinion){
                $commments[$opinion['id']] = $this->model->getCommentsBySubtheme($opinion['id']);
            }
        }
        
        $this->view->setViewData('opinions', $opinions);
        $this->view->setViewData('comments', $commments);
        $this->view->setViewData('likes', $likes);
        
        $this->setViewFile('show_theme');
    }

}