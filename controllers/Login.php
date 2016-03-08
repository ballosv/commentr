<?php

class Login extends Controller{
            
    function __construct() {
        parent::__construct();
        Debug::addMsg('Login-Controller geladen');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function loginUser(){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'userpass', FILTER_SANITIZE_STRING);
        
        $login = $this->model->checkLogin($username, $password);
        
        if($login === 'error'){
            header('Location: ' . BASE_URL . '/error/error-login');
            exit;
        }else{
            if($login === true){
                if(Session::get('user_role') == 1){
                    header('Location: ' . BASE_URL . '/admin');
                    exit;
                }
                
                if(Session::get('user_role') == 0){
                    if(!empty(Session::get('next_page'))){
                        header('Location: ' . BASE_URL . Session::get('next_page'));
                        exit;
                    }
                    header('Location: ' . BASE_URL . '/user');
                    exit;
                }
            }else{
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        }
    }
    
    public function logoutUser(){
        $this->model->logout();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

}