<?php

class Register extends Controller{
            
    function __construct() {
        parent::__construct();
        Debug::addMsg('Register-Controller geladen');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function createUser() {
        
        $name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, 'userpass', FILTER_SANITIZE_STRING);
        
        if(!isset($name) || empty($name)) {
            $error[] = 'Fehlerhafter Name';
        } else {
            $nameExist = $this->model->userExist($name);

            if( $nameExist === true ) {
                $error[] = 'Dieser Name ist bereits vergeben';
            }
            
        }
        
        if(!isset($mail) || empty($mail)) {
            $error[] = 'Fehlerhafte Mail';
        }
        
        if(!isset($pass) || empty($pass)) {
            $error[] = 'Kein valides Passwort';
        }
        
        if( !isset( $error ) ) {
            $msg = $this->model->createUser($name, $mail, $pass);
        }
        
        if( $msg ) {
            // Später eine reine Success Seite redirecten
            $success[] = 'Sie wurden erfolgreich registriert!';
            $this->view->setViewData('msg',$success);
            $this->view->setViewData('class','success');
        } else {
            $this->view->setViewData('msg',$error);
            $this->view->setViewData('class','error');
        }
        
    }

}