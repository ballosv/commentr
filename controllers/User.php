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
    
    public function newOpinion($param){
        $this->view->setViewData('theme_link', $param[0]);
        $this->view->setViewData('subtheme_link', $param[1]);
        $subtheme = $this->model->getThemeByLink($param[1]);
        $this->view->setViewData('subtheme_id', $subtheme['id']);
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
    
    public function newComment($param){
        $this->view->setViewData('subtheme_link', $param[0]);
        $this->view->setViewData('opinion_id', $param[1]);
        $this->setViewFile('new_comment');
    }
    
    public function createNewComment($param){
        Debug::addMsg('Neuer Kommentar wird erstellt.');
        $saveComment = $this->model->createNewComment($param[1]);
        
        if($saveComment === true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }else{
            header('Location: ' . BASE_URL . '/error/error-save-comment');
        }
    }
    
    public function like($params){
        $opinionId = $params[1];
        $save = $this->model->setLikeStatus($opinionId, 1);
        
        if($save === true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }elseif($save === 'already-voted'){
            header('Location: ' . BASE_URL . '/error/error-already-voted');
        }
        else{
            header('Location: ' . BASE_URL . '/error/error-save-like');
        }
    }
    
    public function dislike($params){
        $opinionId = $params[1];
        $save = $this->model->setLikeStatus($opinionId, 0);
        
        if($save === true){
            header('Location: ' . Url::getTempUrl('theme_page'));
        }elseif($save === 'already-voted'){
            header('Location: ' . BASE_URL . '/error/error-already-voted');
        }
        else{
            header('Location: ' . BASE_URL . '/error/error-save-like');
        }
    }

}