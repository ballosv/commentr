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
        $themeLink = $params[0];
        $topicLink = $params[1];
        
        $currentPage = isset(Url::getSubParams()['pgn']) ? Url::getSubParams()['pgn'] : 1;
        $pageCount = isset(Url::getSubParams()['ldc']) ? Url::getSubParams()['ldc'] : INITIAL_LOAD_COUNT;
        
        // Die URL speichern, für den Fall, dass ein abgemeldeter User kommentieren will
        $themePage = Url::printUrl(true);
        // Die Themenseite in die Session speichern
        Url::setTempUrl('theme_page', $themePage);
        
        /*
        * Das Thema laden
        */
        $theme = $this->model->getThemeByLink($themeLink);
        
        
        if($topicLink === NULL){    // Anzeige eines Themas
            
            /*
             * Pagnation erstellen
             */
            // Anzahl vorhandener Topics für Pagination speichern
            $totalCount = $this->model->getTotalTopicCount($theme['id'])['total_count'];
            // Anzahl Seiten berechnen
            $totalPages = ceil($totalCount / $pageCount);
            /*
             * Die Topics laden
             */
            // Die Topics für die angegeben Seite laden. $pageCount bestimmt dabei
            // die Menge der zu ladenden Topics
            $minCount = ($currentPage - 1) * $pageCount;
            $maxCount = $currentPage * $pageCount;
            $topics = $this->model->getTopicsFromThemeByCount($theme['id'], $minCount, $maxCount);
            
            /*
             * Meiungen, Kommentare und Likes bzw. Dislikes der Topics laden
             */
            $opinions = array();
            $AllOpinionsWithComments = array();
            $commments = array();
            $likes = array();

            foreach ($topics as $topic){
                // Gesamtzahl Meinung auslesen
                $totalOpinionsCount[$topic['id']] = $this->model->getTotalOpinionCount($topic['id'])['total_count'];
                // Opinions laden
                $opinions[$topic['id']] = $this->model->getOpinionsFromTopic($topic['id'], 'likes', 0, INITIAL_LOAD_COUNT);
                // Likes der Opinions laden
                foreach($opinions[$topic['id']] as $opinion){
                    $like = $this->model->getLikesByOpinion($opinion['id'], 'count');
                    // Like nur speichern, wenn auch ein Datensatz vorhanden ist
                    if($like !== FALSE){
                        $likes[$opinion['id']] = $like;
                    }
                }
            }
            $this->setViewFile('show_theme');
            
        }else{  // Anzeige eines Topics innerhalb eines Themas
            $topicId = Url::getSubParams()['id'];
            $commentId = isset(Url::getSubParams()['com']) ? Url::getSubParams()['com'] : NULL;

            // Topic laden
            $topics = $this->model->getTopicById($topicId);

            /*
             * Pagnation erstellen
             */
            // Anzahl vorhandener Topics für Pagination speichern
            $totalCount = $this->model->getTotalOpinionCount($topics['id'])['total_count'];
            // Anzahl Seiten berechnen
            $totalPages = ceil($totalCount / $pageCount);


            // Opinions laden
            $minCount = ($currentPage - 1) * $pageCount;
            $maxCount = $currentPage * $pageCount;
            $opinions = $this->model->getOpinionsFromTopic($topics['id'], 'likes', $minCount, $maxCount);

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
            $this->setViewFile('show_topic');
            
        }
        
        $this->view->setViewData('theme', $theme);
        $this->view->setViewData('topics', $topics);
        $this->view->setViewData('current_page', $currentPage);
        $this->view->setViewData('total_pages', $totalPages);
//        $this->view->setViewData('total_count', $totalCount);
        $this->view->setViewData('opinions', $opinions);
//        $this->view->setViewData('total_opinions_count', $totalOpinionsCount);
        $this->view->setViewData('likes', $likes);
        
    }
    
    public function themesList(){
        $currentPage = isset(Url::getSubParams()['pgn']) ? Url::getSubParams()['pgn'] : 1;
        $pageCount = isset(Url::getSubParams()['ldc']) ? Url::getSubParams()['ldc'] : INITIAL_LOAD_COUNT;
        
        /*
        * Pagnation erstellen
        */
        // Anzahl vorhandener Topics für Pagination speichern
        $totalCount = $this->model->getTotalThemeCount()['total_count'];
        // Anzahl Seiten berechnen
        $totalPages = ceil($totalCount / $pageCount);
        
        /*
         * Es muss die Anzahl Themen geladen werden - funktioniert noch nicht!!!!!!!!!
         */
        $themes = $this->model->getThemesByRelevance($currentPage*INITIAL_LOAD_COUNT);
        
        
        $this->view->setViewData('themes', $themes);
        $this->view->setViewData('current_page', $currentPage);
        $this->view->setViewData('total_pages', $totalPages);
        
        $this->setViewFile('themes_list');
    }
    
}