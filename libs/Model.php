<?php

class Model {

    protected $db;
            
    function __construct() {
        Debug::addMsg('Base-Model wurde geladen');
        $this->db = new Database();
    }
    
    public function getThemesByCount($minCount = NULL, $maxCount = NULL){
        Debug::addMsg('Themen werden nachgeladen');
        if($minCount === NULL || $maxCount === NULL){
            $query = $this->db->prepare("SELECT * FROM themes WHERE parent = 0 AND status = 1");
            $query->execute();
        }else{
            $query = $this->db->prepare("SELECT * FROM themes WHERE parent = 0 AND status = 1 ORDER BY date LIMIT $minCount, $maxCount");
            $query->execute(array(
                ':min_count' => $minCount,
                ':max_count' => $maxCount
            ));
        }
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
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
    
    public function getTotalSubthemeCount($themeId){
        $query = $this->db->prepare("SELECT COUNT(*) AS total_count FROM themes WHERE parent = :theme_id AND status = 1");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }


    public function getSubthemesFromThemeByCount($themeId, $minCount = NULL, $maxCount = NULL){
        Debug::addMsg('Themen werden nachgeladen');
        if($minCount === NULL || $maxCount === NULL){
            $query = $this->db->prepare("SELECT * FROM themes WHERE parent = :theme_id AND status = 1");
            $query->execute(array(
                ':theme_id' => $themeId
            ));
        }else{
            $query = $this->db->prepare("SELECT * FROM themes WHERE parent = $themeId AND status = 1 ORDER BY date LIMIT $minCount, $maxCount");
            $query->execute(array(
                ':theme_id' => $themeId,
                ':min_count' => $minCount,
                ':max_count' => $maxCount
            ));
        }
        
        $data = $query->fetchAll(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }
    
    public function getDateFromLastSubtheme($themeId){
        Debug::addMsg('Datum des letzten Beitrags auslesen');
        
        $query = $this->db->prepare("SELECT date FROM themes WHERE parent = :theme_id ORDER BY id DESC LIMIT 1");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetch(FETCH_MODE);

        if(!empty($data)){
            return $data;
        }
        
        return false;
    }
    
    public function getSubthemesFromThemeByDate($themeId, $from, $to){
        Debug::addMsg('Unterthemen eines Themas innerhalb eines Zeitraums werden geladen');
        
        $query = $this->db->prepare("SELECT * FROM themes WHERE parent = :theme_id AND status = 1 AND date BETWEEN FROM_UNIXTIME(:from) AND FROM_UNIXTIME(:to)");
        $query->execute(array(
            ':theme_id' => $themeId,
            ':from' => $from,
            ':to' => $to
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        if(!empty($data)){
            return $data;
        }
        
        return false;
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
    
    public function getCommentsBySubtheme($opinionId, $limit = FALSE){
        Debug::addMsg('Alle Kommentare eines Subthemes holen');
        if($limit === FALSE){
            $query = "SELECT "
                . "comments.id, "
                . "comments.opinion_id, "
                . "comments.user_id,"
                . "users.name as username,"
                . "comments.title,"
                . "comments.text,"
                . "comments.date "
                . "FROM comments JOIN users ON comments.user_id = users.id "
                . "WHERE opinion_id = :opinion_id";
        }
        
        if($limit > 0){
            $query = "SELECT "
                . "comments.id, "
                . "comments.opinion_id, "
                . "comments.user_id,"
                . "users.name as username,"
                . "comments.title,"
                . "comments.text,"
                . "comments.date "
                . "FROM comments JOIN users ON comments.user_id = users.id "
                . "WHERE opinion_id = :opinion_id "
                . "LIMIT " . $limit;
        }
        
        $query = $this->db->prepare($query);
        
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
    
    public function getLikesByOpinion($opinionId, $format = 'count'){
        Debug::addMsg('Anzahl Likes einer Meinung werden ausgelesen');
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Likes holen
            if($format === 'count'){
                $query = $this->db->prepare("SELECT COUNT(*) AS likes FROM opinion_has_likes WHERE opinion_id = :opinion_id AND like_status = '1'");
            }

            if($format === 'data'){
                $query = $this->db->prepare("SELECT * FROM opinion_has_likes WHERE opinion_id = :opinion_id AND like_status = '1'");
            }
            
            $query->execute(array(
                'opinion_id' => $opinionId
            ));
            
            $likes = $query->fetchAll(FETCH_MODE);
            $likesCount = $query->rowCount();
            
            // dislikes holen
            if($format === 'count'){
                $query = $this->db->prepare("SELECT COUNT(*) AS dislikes FROM opinion_has_likes WHERE opinion_id = :opinion_id AND like_status = '0'");
            }

            if($format === 'data'){
                $query = $this->db->prepare("SELECT * FROM opinion_has_likes WHERE opinion_id = :opinion_id AND like_status = '0'");
            }
            
            $query->execute(array(
                'opinion_id' => $opinionId
            ));
            
            $dislikes = $query->fetchAll(FETCH_MODE);
            $dislikesCount = $query->rowCount();
            
            // Durchführen der Warteschleife
            $this->db->commit();
        } catch (PDOException $ex) {
            // Wenn es Fehler gab, Vorgänge rückgängig machen
            $this->db->rollback();
        }
        
        $opinionLikes['likes'] = $likes[0]['likes'];
        $opinionLikes['dislikes'] = $dislikes[0]['dislikes'];
        
        if($opinionLikes != NULL){
            return $opinionLikes;
        }
        
        return FALSE;
        
    }
    
    public function clearString($str, $how = '-'){
        $search = array("ä", "ö", "ü", "ß", "Ä", "Ö", "Ü");
        $replace = array("ae", "oe", "ue", "ss", "Ae", "Oe", "Ue");
        $str = str_replace($search, $replace, $str);
        $str = strtolower(preg_replace("/[^a-zA-Z0-9]+/", trim($how), $str));
        return $str;
    }
    

}