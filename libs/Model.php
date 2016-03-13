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
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getAllSubthemesByTheme($themeId){
        Debug::addMsg('Alle Unterthemen eines Themas werden geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE parent = :theme_id AND status = 1 ORDER BY date");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getOpinionsBySubtheme($themeId){
        Debug::addMsg('Alle Meinungen eines Unterthemas werden geladen');
        $query = $this->db->prepare("SELECT * FROM opinions WHERE theme_id = :theme_id AND status = 1 ORDER BY date");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getCommentedOpinionsBySubtheme($themeId){
        Debug::addMsg('Alle kommentierten Meinungen eines Unterthemas werden geladen');
        $query = $this->db->prepare("SELECT * FROM opinions WHERE theme_id = :theme_id AND status = 1 AND comments > 0 ORDER BY date");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getAllCategories(){
        Debug::addMsg('Alle Kategorien werden geladen');
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getCurrentThemes(){
        Debug::addMsg('Aktuelle Themen wurden geladen');
        $query = $this->db->prepare("SELECT * FROM themes WHERE status = 1 ORDER BY date LIMIT 5");
        $query->execute();
        
        $data = $query->fetchAll(FETCH_MODE);
        
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
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data[0];
        }
    }
    
    public function getThemeByLink($link){
        Debug::addMsg('Ein Thema wird geladen');
        
        $query = $this->db->prepare("SELECT * FROM themes WHERE link = :link AND status = 1 LIMIT 1");
        $query->execute(array(
            'link' => $link
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data[0];
        }
    }
    
    public function getCommentsBySubtheme($opinionId){
        Debug::addMsg('Alle Kommentare eines Subthemes holen');
        $query = $this->db->prepare("SELECT "
                . "comments.id, "
                . "comments.opinion_id, "
                . "comments.user_id,"
                . "users.name as username,"
                . "comments.title,"
                . "comments.text,"
                . "comments.date "
                . "FROM comments JOIN users ON comments.user_id = users.id "
                . "WHERE opinion_id = :opinion_id"
                );
        $query->execute(array(
            'opinion_id' => $opinionId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getAllComments(){
        Debug::addMsg('Alle Kommentare holen');
        $query = $this->db->prepare("SELECT * FROM comments");
        $query->execute();
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data[0];
        }
    }
    
    public function clearString($str, $how = '-'){
        $search = array("ä", "ö", "ü", "ß", "Ä", "Ö", "Ü");
        $replace = array("ae", "oe", "ue", "ss", "Ae", "Oe", "Ue");
        $str = str_replace($search, $replace, $str);
        $str = strtolower(preg_replace("/[^a-zA-Z0-9]+/", trim($how), $str));
        return $str;
    }
    

}