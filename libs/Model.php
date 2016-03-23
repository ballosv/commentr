<?php

class Model {

    protected $db;
            
    function __construct() {
        Debug::addMsg('Base-Model wurde geladen');
        $this->db = new Database();
    }
    
    /*
     * Themes
     */
    
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
    
    public function getTotalThemeCount(){
        $query = $this->db->prepare("SELECT COUNT(*) AS total_count FROM themes WHERE parent = 0 AND status = 1");
        $query->execute();
        
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }
    
    
    
    
    /*
     * Topics
     */
    public function getTopicById($topicId){
        Debug::addMsg('Topic wird geladen');
        $query = $this->db->prepare("SELECT * FROM topics WHERE id = :topic_id AND status = 1");
        $query->execute(array(
            ':topic_id' => $topicId
        ));
        
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
    }
    
    public function getTopicByLink($topicLink, $themeId){
        Debug::addMsg('Topic wird geladen');
        $query = $this->db->prepare("SELECT * FROM topics WHERE link = :topic_link AND theme_id = :theme_id AND status = 1");
        $query->execute(array(
            ':topic_link' => $topicLink,
            ':theme_id' => $themeId
        ));
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
    }
    
    public function getAllTopicsByTheme($themeId){
        Debug::addMsg('Alle Unterthemen eines Themas werden geladen');
        $query = $this->db->prepare("SELECT * FROM topics WHERE theme_id = :theme_id AND status = 1 ORDER BY date DESC");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    public function getTopicsFromThemeByCount($themeId, $minCount = NULL, $maxCount = NULL){
        Debug::addMsg('Themen werden nachgeladen');
        if($minCount === NULL || $maxCount === NULL){
            $query = $this->db->prepare("SELECT * FROM topics WHERE theme_id = :theme_id AND status = 1 ORDER BY date DESC");
            $query->execute(array(
                ':theme_id' => $themeId
            ));
        }else{
            $query = $this->db->prepare("SELECT * FROM topics WHERE theme_id = $themeId AND status = 1 ORDER BY date DESC LIMIT $minCount, $maxCount");
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
    
    public function getTotalTopicCount($themeId){
        $query = $this->db->prepare("SELECT COUNT(*) AS total_count FROM topics WHERE theme_id = :theme_id AND status = 1");
        $query->execute(array(
            ':theme_id' => $themeId
        ));
        
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }
    
    public function getDateFromLastTopic($id){
        Debug::addMsg('Datum des letzten Beitrags auslesen');
        
        $query = $this->db->prepare("SELECT date FROM topics WHERE id = :id ORDER BY id DESC LIMIT 1");
        $query->execute(array(
            ':id' => $id
        ));
        
        $data = $query->fetch(FETCH_MODE);

        if(!empty($data)){
            return $data;
        }
        
        return false;
    }
    
    public function getTopicsFromThemeByDate($themeId, $from, $to){
        Debug::addMsg('Unterthemen eines Themas innerhalb eines Zeitraums werden geladen');
        
        $query = $this->db->prepare("SELECT * FROM topics WHERE theme_id = :theme_id AND status = 1 AND date BETWEEN FROM_UNIXTIME(:from) AND FROM_UNIXTIME(:to) ORDER BY date DESC");
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
    
    /*
     * Opinions
     */
    public function getTotalOpinionCount($topicId){
        $query = $this->db->prepare("SELECT COUNT(*) AS total_count FROM opinions WHERE topic_id = :topic_id AND status = 1 ORDER BY topic_id");
        $query->execute(array(
            ':topic_id' => $topicId
        ));
        
        $data = $query->fetch(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }
    
    public function getOpinionsFromTopic($topicId, $filter = false, $minCount = NULL, $maxCount = NULL){
        Debug::addMsg('Alle Meinungen eines Unterthemas werden geladen');
        if($minCount === NULL || $maxCount === NULL){
            $limit;
        }else{
            $limit = "LIMIT $minCount, $maxCount";
        }
        
        // Default Filter läd Meinungen chronologisch sortiert        
        if($filter === false){
            $query = $this->db->prepare("SELECT * FROM opinions WHERE topic_id = :topic_id AND status = 1 ORDER BY date $limit");
        }
        
        if($filter === 'comments'){
            $query = $this->db->prepare("SELECT * FROM opinions WHERE topic_id = :topic_id AND status = 1 ORDER BY comments DESC, date DESC $limit");
        }
        
        if($filter === 'likes'){
            $query = $this->db->prepare("
                SELECT  
                opinions.id,
                opinions.topic_id,
                opinions.user_id,
                opinions.title,
                opinions.text,
                opinions.date,
                opinions.status,
                opinions.comments,
                COUNT(opinion_has_likes.like_status) AS like_count
                FROM opinions
                LEFT JOIN opinion_has_likes ON opinion_has_likes.opinion_id = opinions.id
                WHERE opinions.topic_id = :topic_id AND opinions.status = 1
                GROUP BY opinions.id
                ORDER BY like_count DESC, opinions.date DESC
                $limit"
            );
        }
        
        $query->execute(array(
            ':topic_id' => $topicId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        if($data){
            return $data;
        }
        
        return false;
    }
    
    
    /*
     * Comments
     */
    public function getCommentsByOpinion($opinionId){
        Debug::addMsg('Alle Kommentare einer Meinung auslesen');
        
        $query = $this->db->prepare("
                SELECT 
                comments.id,
                comments.opinion_id,
                comments.user_id,
                comments.title,
                comments.text,
                comments.date,
                users.name AS username
                FROM comments 
                JOIN users ON comments.user_id = users.id
                WHERE opinion_id = :opinion_id 
                ORDER BY date DESC
                ");
        $query->execute(array(
            ':opinion_id' => $opinionId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        if($data){
            return $data;
        }
    }
    
    public function getCommentedOpinionsByTopic($topicId){
        Debug::addMsg('Alle kommentierten Meinungen eines Unterthemas werden geladen');
        $query = $this->db->prepare("SELECT * FROM opinions WHERE topic_id = :topic_id AND status = 1 AND comments > 0 ORDER BY date DESC");
        $query->execute(array(
            ':topic_id' => $topicId
        ));
        
        $data = $query->fetchAll(FETCH_MODE);
        
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            return $data;
        }
    }
    
    
    /*
     * Categories
     */
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
    
//    SELECT COUNT(opinion_id) AS like_count FROM opinion_has_likes GROUP BY opinion_id
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