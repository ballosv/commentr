<?php

class User_Model extends Model {

    function __construct() {
        parent::__construct();
        Debug::addMsg('User_Model wurde geladen');
    }
    
    public function createNewOpinion($themeId){
        Debug::addMsg('Neue Meinung wird gespeichert');
        $title = filter_input(INPUT_POST, 'opinion-title', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'opinion-text', FILTER_SANITIZE_STRING);
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

}