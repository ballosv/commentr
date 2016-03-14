<?php

class User_Model extends Model {

    function __construct() {
        parent::__construct();
        Debug::addMsg('User_Model wurde geladen');
    }
    
    public function createNewOpinion($theme_link){
        
        Debug::addMsg('Neue Meinung wird gespeichert');
        $title = filter_input(INPUT_POST, 'opinion-title', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'opinion-text', FILTER_SANITIZE_STRING);
        $themeId = filter_input(INPUT_POST, 'subtheme_id', FILTER_SANITIZE_STRING);
        $userId = Session::get('user_id');
        
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Meinung speichern
            $query = $this->db->prepare("INSERT INTO opinions (theme_id, user_id, title, text, status) VALUES (:theme_id, :user_id, :title, :text, :status)");
            $save = $query->execute(array(
                ':theme_id' => $themeId,
                ':user_id' => $userId,
                ':title' => $title,
                ':text' => $text,
                ':status' => 1
            ));
            
            /*
             * END Queries
             */
            
            // Durchführen der Warteschleife
            $this->db->commit();
        } catch (PDOException $ex) {
            // Wenn es Fehler gab, Vorgänge rückgängig machen
            $this->db->rollback();
        }
        
        return $save;
        
    }
    
    public function createNewComment($opinionId){
        Debug::addMsg('Neuer Kommentar wird gespeichert');
        $title = filter_input(INPUT_POST, 'comment-title', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'comment-text', FILTER_SANITIZE_STRING);
        $userId = Session::get('user_id');
        
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Meinung speichern
            $query = $this->db->prepare("INSERT INTO comments (opinion_id, user_id, title, text) VALUES (:opinion_id, :user_id, :title, :text)");
            $save = $query->execute(array(
                ':opinion_id' => $opinionId,
                ':user_id' => $userId,
                ':title' => $title,
                ':text' => $text
            ));
            
            // Die zuletzt gespeicherte ID
            $lastId = $this->db->lastInsertId();
            
            // Anzahl Kommentare erhöhen
            $query = $this->db->prepare("UPDATE opinions SET comments = comments+1 WHERE id = :last_id");
            $save = $query->execute(array(
                ':last_id' => $lastId
            ));
            
            /*
             * END Queries
             */
            
            // Durchführen der Warteschleife
            $this->db->commit();
        } catch (PDOException $ex) {
            // Wenn es Fehler gab, Vorgänge rückgängig machen
            $this->db->rollback();
        }
        
        return $save;
    }

    public function setLikeStatus($opinionId, $likeStatus){
        Debug::addMsg('Like wird gespeichert');
        $userId = Session::get('user_id');
        
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            $query = $this->db->prepare("SELECT * FROM opinion_has_likes WHERE opinion_id = :opinion_id AND user_id = :user_id");
            $select = $query->execute(array(
                ':opinion_id' => $opinionId,
                ':user_id' => $userId
            ));
            
            $rowCount = $query->rowCount();
            if($rowCount > 0){
                return 'already-voted';
            }
            
            $query = $this->db->prepare("INSERT INTO opinion_has_likes (opinion_id, user_id, like_status) VALUES (:opinion_id, :user_id, :like_status)");
            $save = $query->execute(array(
                ':opinion_id' => $opinionId,
                ':user_id' => $userId,
                ':like_status' => $likeStatus
            ));
            
            // Durchführen der Warteschleife
            $this->db->commit();
        } catch (PDOException $ex) {
            // Wenn es Fehler gab, Vorgänge rückgängig machen
            $this->db->rollback();
        }
        
        return $save;
    }
    
}