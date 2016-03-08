<?php

class Model {

    protected $db;
            
    function __construct() {
        Debug::addMsg('Base-Model wurde geladen');
        $this->db = new Database();
    }
    
    public function getAllThemes(){
        Debug::addMsg('Alle Themen werden geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE parent = 0 AND status = 1");
        $query->execute();
        
        $data = $query->fetchAll();
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getAllSubthemesByTheme($theme_id){
        Debug::addMsg('Alle Unterthemen eines Themas werden geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE parent = :theme_id AND status = 1 ORDER BY date");
        $query->execute(array(
            ':theme_id' => $theme_id
        ));
        
        $data = $query->fetchAll();
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getAllCategories(){
        Debug::addMsg('Alle Kategorien werden geladen');
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        
        $data = $query->fetchAll();
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getCurrentThemes(){
        Debug::addMsg('Aktuelle Themen wurden geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE status = 1 ORDER BY date LIMIT 5");
        $query->execute();
        
        $data = $query->fetchAll();
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getThemeById($theme_id){
        Debug::addMsg('Ein Thema wird geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE id = :theme_id AND status = 1 LIMIT 1");
        $query->execute(array(
            'theme_id' => $theme_id
        ));
        
        $data = $query->fetchAll();
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data[0];
        }
    }
    
    

}