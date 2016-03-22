<?php

class Theme extends Controller {

    function __construct() {
        parent::__construct();
Debug::addMsg('Theme-Controller wurde geladen');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function showThemes($params){
//        http://localhost:8888/theme/show-themes/fluechtlingskrise?pgn=2?ldc=20
        
        $link = $params[0];
        $currentPage = isset(Url::getSubParams()['pgn']) ? Url::getSubParams()['pgn'] : 1;
        $pageCount = isset(Url::getSubParams()['ldc']) ? Url::getSubParams()['ldc'] : INITIAL_LOAD_COUNT;
         
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
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
            $opinions[$subtheme['id']] = $this->model->getOpinionsFromSubtheme($subtheme['id'], 'likes', 0, INITIAL_LOAD_COUNT);
            // Likes der Opinions laden
            foreach($opinions[$subtheme['id']] as $opinion){
                $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
                // Like nur speichern, wenn auch ein Datensatz vorhanden ist
                if($like !== FALSE){
                    $likes[$opinion['id']] = $like;
                }
            }
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

        $this->setViewFile('show_themes');
    }
    
    public function showTheme($params){
        $themeLink = $params[0];
        $subthemeLink = $params[1];
        
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
        $themePage = Url::printUrl(true);
        // Die Themenseite in die Session speichern
        Url::setTempUrl('theme_page', $themePage);
        
        $currentPage = isset(Url::getSubParams()['pgn']) ? Url::getSubParams()['pgn'] : 1;
        $pageCount = isset(Url::getSubParams()['ldc']) ? Url::getSubParams()['ldc'] : INITIAL_LOAD_COUNT;
        $commentId = isset(Url::getSubParams()['com']) ? Url::getSubParams()['com'] : NULL;
        
        // Theme und Subtheme laden
        $theme = $this->model->getThemeByLink($themeLink);
        $subtheme = $this->model->getSubthemeByLink($subthemeLink, $theme['id']);

        /*
         * Pagnation erstellen
         */
        // Anzahl vorhandener Subthemen für Pagination speichern
        $totalOpinionsCount = $this->model->getTotalOpinionCount($subtheme['id'])['total_count'];;
        // Anzahl Seiten berechnen
        $totalPages = ceil($totalOpinionsCount / $pageCount);
        
        
        // Opinions laden
        $minCount = ($currentPage - 1) * $pageCount;
        $maxCount = $currentPage * $pageCount;
        $opinions = $this->model->getOpinionsFromSubtheme($subtheme['id'], 'likes', $minCount, $maxCount);
        
        // Likes der Opinions laden
        foreach($opinions as $opinion){
            $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
            // Like nur speichern, wenn auch ein Datensatz vorhanden ist
            if($like !== FALSE){
                $likes[$opinion['id']] = $like;
            }
        }
        
        if($commentId !== NULL){
            $comments = $this->model->getCommentsByOpinion($commentId);
            if($comments){
                $this->view->setViewData('comments', $comments);
            }
        }
        
//            $opinionsWithComments = $this->model->getCommentedOpinionsBySubtheme($subtheme['id']);
//            var_dump($opinionsWithComments);
//            if($opinionsWithComments !== NULL){
//                $AllOpinionsWithComments[$subtheme['id']] = $opinionsWithComments;
//            }
//            // Kommentare auslesen
//            foreach ($AllOpinionsWithComments[$subtheme['id']] as $opinion){
//                $commments[$opinion['id']] = $this->model->getCommentsBySubtheme($opinion['id']);
//            }
        
        
        $this->view->setViewData('theme', $theme);
        $this->view->setViewData('subtheme', $subtheme);
        $this->view->setViewData('opinions', $opinions);
        $this->view->setViewData('total_opinions_count', $totalOpinionsCount);
        $this->view->setViewData('current_page', $currentPage);
        $this->view->setViewData('total_pages', $totalPages);
        $this->view->setViewData('likes', $likes);
        
        $this->setViewFile('show_theme');
    }

}