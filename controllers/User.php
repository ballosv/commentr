<?php

class User extends Controller {

    function __construct() {
        parent::__construct();
        Debug::addMsg('User-Controller geladen');
        if(Url::getRedirectPage()){
            Url::setRedirectPage(Url::printUrl(true));
        }
        
        if($this->loginStatus == false || $this->userRole !== 0){
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function newOpinion($params){
//        $this->view->setViewData('theme_link', $params[0]);
//        $this->view->setViewData('topic_link', $params[1]);
        $theme = $this->model->getThemeByLink($params[0]);
//        $topic = $this->model->getTopicByLink($params[1], $themeId);
        $topic = $this->model->getTopicById(Url::getSubParams()['id']);
        
        $this->view->setViewData('theme_link', $theme['link']);
        $this->view->setViewData('topic_id', $topic['id']);

        $this->setViewFile('new_opinion');
    }
    
    public function createNewOpinion($params){
        $saveOpinion = $this->model->createNewOpinion($params[0]);

        if($saveOpinion === true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }else{
            header('Location: ' . BASE_URL . '/error/error-save-opinion');
        }
    }
    
    public function newComment($params){
        $this->view->setViewData('theme_link', $params[0]);
        $this->view->setViewData('topic_link', $params[1]);
        $this->view->setViewData('opinion_id', $params[2]);
        $this->setViewFile('new_comment');
    }
    
    public function createNewComment($params){
        Debug::addMsg('Neuer Kommentar wird erstellt.');
        $saveComment = $this->model->createNewComment($params[0], $params[2]);
        
        if($saveComment === true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }else{
            header('Location: ' . BASE_URL . '/error/error-save-comment');
        }
    }
    
    public function like($params){
        $opinionId = $params[1];
        
        $statusLike = $this->model->checkVote($opinionId);
        
        if($statusLike === false){
            $vote = $this->model->setLikeStatus($opinionId, 1);
        }
        else{
            if($statusLike == 0){
                $vote = $this->model->updateLikeStatus($opinionId, '1');
            }else{
                $vote = true;
            }
        }

        if($vote == true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }else{
            header('Location: ' . BASE_URL . '/error/error-save-like');
        }
    }
    
    public function dislike($params){
        $opinionId = $params[1];
        
        $statusLike = $this->model->checkVote($opinionId);
        
        if($statusLike === false){
            $vote = $this->model->setLikeStatus($opinionId, '0');
        }
        else{
            if($statusLike == 1){
                $vote = $this->model->updateLikeStatus($opinionId, '0');
            }else{
                $vote = true;
            }
        }
        
        if($vote == true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }else{
            header('Location: ' . BASE_URL . '/error/error-save-like');
        }
    }

}