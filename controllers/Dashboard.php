<?php

class Dashboard extends Controller {
    
    function __construct() {
        parent::__construct();
Debug::addMsg('Dashboard geladen');
    }
    
    public function index(){
        $this->renderView();
    }
}

