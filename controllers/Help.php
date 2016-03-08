<?php

class Help extends Controller {
            
    function __construct() {
        parent::__construct();
        Debug::addMsg('Help Controller');
    }
    
    public function index(){
        $this->renderView();
    }
    
    public function other($param = false){
        $this->setViewFile('other');
        
        $output = '<p>';
        
        foreach ($param as $val){
            $output .= $val . ' ';
        }
        
        $output .= '</p>';
        
        $this->view->setViewData($output);
    }

}