<?php

class Theme extends Controller {

    function __construct() {
        parent::__construct();
Debug::addMsg('Theme-Controller wurde geladen');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function showTheme($params){
//        http://localhost:8888/theme/show-theme/fluechtlingskrise?pgn=2?ldc=20
        
        $link = $params[0];
        $currentPage = isset(Url::getSubParams()['pgn']) ? Url::getSubParams()['pgn'] : 1;
        $pageCount = isset(Url::getSubParams()['ldc']) ? Url::getSubParams()['ldc'] : INITIAL_LOAD_COUNT;
        

//        $minCount = isset($params[1]) ? $params[1] : NULL;
//        $maxCount = isset($params[2]) ? $params[2] : NULL;
//        $loadMoreOpinions = (isset($params[3]) && $params[3] == 'load-more-opinions') ? true : false;
//        if($loadMoreOpinions === true){
//            $minOpinionCount = $params[4];
//            $maxOpinionCount = $params[5];
//        }
         
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
//        $themePage = '/theme/show-theme/' . $link;
        $themePage = Url::printUrl(true);
        // Die Themenseite in die Session speichern
        Url::setTempUrl('theme_page', $themePage);
        
        /*
         * Das Thema laden
         */
        $theme = $this->model->getThemeByLink($link);
        
        /*
         * Pagnation erstellen
         */
        // Anzahl vorhandener Subthemen für Pagination speichern
        $totalCount = $this->model->getTotalSubthemeCount($theme['id'])['total_count'];
        // Anzahl Seiten berechnen
        $totalPages = ceil($totalCount / $pageCount);
        
        /*
         * Die Subthemen laden
         */
        
        // Die Subthemes für die angegeben Seite laden. $pageCount bestimmt dabei
        // die Menge der zu ladenden Subthemes
        $minCount = ($currentPage - 1) * $pageCount;
        $maxCount = $currentPage * $pageCount;
        $subthemes = $this->model->getSubthemesFromThemeByCount($theme['id'], $minCount, $maxCount);
        
        
//        if($minCount === NULL || $maxCount === NULL || INITIAL_LOAD_COUNT < $totalCount){
//            // Das Datum des letzten Subthemes laden
//            $lastSubthemeDate = $this->model->getDateFromLastSubtheme($theme['id']);
//            // Die letzten Subthemes laden
//            $from = strtotime($lastSubthemeDate['date']) - DEFAULT_PERIOD;
//            $to = time();
//            $subthemes = $this->model->getSubthemesFromThemeByDate($theme['id'], $from, $to);
//            // Wenn es zu wenig Subthemes gibt, soll eine Mindestmenge geladen werden
//            if(count($subthemes) < INITIAL_LOAD_COUNT){
//                $subthemes = $this->model->getSubthemesFromThemeByCount($theme['id'], 0, INITIAL_LOAD_COUNT);
//            }
//        }else{
//            // Wenn min- und maxCount vorhanden sind, die entsprechenden Subthemes laden
//            $maxCount = $totalCount >= $maxCount ? $maxCount : $totalCount;
//            $subthemes = $this->model->getSubthemesFromThemeByCount($theme['id'], $minCount, $maxCount);
//        }
        
        
        /*
         * Meiungen, Kommentare und Likes bzw. Dislikes der Subthemes laden
         */
        $opinions = array();
        $AllOpinionsWithComments = array();
        $commments = array();
        $likes = array();
        
        foreach ($subthemes as $subtheme){
            // Gesamtzahl Meinung auslesen
            $totalOpinionsCount[$subtheme['id']] = $this->model->getTotalOpinionCount($subtheme['id'])['total_count'];
            // Opinions laden
            $opinions[$subtheme['id']] = $this->model->getOpinionsFromSubtheme($subtheme['id'], 'likes');
            // Likes der Opinions laden
            foreach($opinions[$subtheme['id']] as $opinion){
                $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
                // Like nur speichern, wenn auch ein Datensatz vorhanden ist
                if($like !== FALSE){
                    $likes[$opinion['id']] = $like;
                }
            }
            
//            $opinionsWidthComments = $this->model->getCommentedOpinionsBySubtheme($subtheme['id'], '');
//            if($opinionsWidthComments !== NULL){
//                $AllOpinionsWithComments[$subtheme['id']] = $opinionsWidthComments;
//            }
//            // Kommentare auslesen
//            foreach ($AllOpinionsWithComments[$subtheme['id']] as $opinion){
//                $commments[$opinion['id']] = $this->model->getCommentsBySubtheme($opinion['id']);
//            }
        }
        
        $this->view->setViewData('theme', $theme);
        $this->view->setViewData('subthemes', $subthemes);
        $this->view->setViewData('current_page', $currentPage);
        $this->view->setViewData('total_pages', $totalPages);
        $this->view->setViewData('total_subtheme_count', $totalCount);
        $this->view->setViewData('opinions', $opinions);
        $this->view->setViewData('total_opinions_count', $totalOpinionsCount);
        $this->view->setViewData('likes', $likes);
        $this->view->setViewData('comments', $commments);
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
//        $subthemes = $this->model->getAllSubthemesByTheme($theme['id']);
        

        // Funktioniert hier nicht, weil noch nicht bekannt ist, zu welchem Subtheme eine Meinung gespeichert werden soll
//        $redirectUrl = '/user/new-opinion/' . $theme['link'] . '/' . $link;
//        Url::setRedirectPage($redirectUrl);
        
        // Alle Meinungen, Kommentare und Likes bzw. Dislikes der Subthemes auslesen und speichern
//        $opinions = array();
//        $AllOpinionsWithComments = array();
//        $commments = array();
//        $likes = array();
//        
//        foreach ($subthemes as $subtheme){
//            $opinions[$subtheme['id']] = $this->model->getOpinionsBySubtheme($subtheme['id']);
//            foreach($opinions[$subtheme['id']] as $opinion){
//                $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
//                // Like nur speichern, wenn auch ein Datensatz vorhanden ist
//                if($like !== FALSE){
//                    $likes[$opinion['id']] = $like;
//                }
//            }
//            
//            $opinionsWidthComments = $this->model->getCommentedOpinionsBySubtheme($subtheme['id'], '');
//            if($opinionsWidthComments !== NULL){
//                $AllOpinionsWithComments[$subtheme['id']] = $opinionsWidthComments;
//            }
//            // Kommentare auslesen
//            foreach ($AllOpinionsWithComments[$subtheme['id']] as $opinion){
//                $commments[$opinion['id']] = $this->model->getCommentsBySubtheme($opinion['id']);
//            }
//        }
//        
//        $this->view->setViewData('opinions', $opinions);
//        $this->view->setViewData('comments', $commments);
//        $this->view->setViewData('likes', $likes);
//        
        $this->setViewFile('show_theme');
    }

}