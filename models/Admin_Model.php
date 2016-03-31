<?php

class Admin_Model extends Model {

    function __construct() {
        parent::__construct();
        Debug::addMsg('Admin_Model wurde geladen');
    }
    
    public function createNewTheme(){
        Debug::addMsg('Neues Thema wird erstellt');
        $themeTitle = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $themeTeaser = filter_input(INPUT_POST, 'teaser', FILTER_SANITIZE_STRING);
        $themeRelation = filter_input(INPUT_POST, 'related_theme', FILTER_SANITIZE_STRING);
        $themeCategory = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $themeImage = $_FILES['image']['name'];
        
        // Neues Thema in Datenbank schreiben und Kategorie abspeichern
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Thema speichern
            $query = $this->db->prepare("INSERT INTO themes (link, name, teaser, image, status) VALUES (:link, :name, :teaser, :image, :status)");
            $save = $query->execute(array(
                ':link' => self::clearString($themeTitle),
                ':name' => $themeTitle,
                ':teaser' => $themeTeaser,
                ':image' => $themeImage,
                ':status' => 1
            ));
            
              
            // Die zuletzt gespeicherte ID
            $lastId = $this->db->lastInsertId();
            
            // Speichern der Kategorie
            $query = $this->db->prepare("INSERT INTO themes_has_categories (theme_id, category_id) VALUES (:theme, :category)");
            $save = $query->execute(array(
                ':theme' => $lastId,
                ':category' => $themeCategory
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
    
    public function deactivateTheme($themeLink){
        Debug::addMsg('Thema wird deaktiviert');
        // Neues Thema in Datenbank schreiben und Kategorie abspeichern
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Thema löschen
            $query = $this->db->prepare("UPDATE themes SET status = 0 WHERE link = :link");
            $deactivate = $query->execute(array(
                ':link' => $themeLink
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
        
        return $deactivate;
    }
    
    public function activateTheme($themeLink){
Debug::addMsg('Thema wird aktiviert');
        // Neues Thema in Datenbank schreiben und Kategorie abspeichern
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Thema löschen
            $query = $this->db->prepare("UPDATE themes SET status = 1 WHERE link = :link");
            $activate = $query->execute(array(
                ':link' => $themeLink
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
        
        return $activate;
    }
    
    public function getAllDeactivatedThemes(){
        Debug::addMsg('Alle deaktivierten Themes anzeigen ');
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Thema löschen
            $query = $this->db->prepare("SELECT * FROM themes WHERE status = 0");
            $query->execute();
            $data = $query->fetchAll(FETCH_MODE);
            
            /*
             * END Queries
             */
            
            // Durchführen der Warteschleife
            $this->db->commit();
        } catch (PDOException $ex) {
            // Wenn es Fehler gab, Vorgänge rückgängig machen
            $this->db->rollback();
        }
        
        return $data;
    }

    
    public function createNewTopic(){
        Debug::addMsg('Ein neuer Topic wird erstellt');
        $topicTitle = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $topicTeaser = filter_input(INPUT_POST, 'teaser', FILTER_SANITIZE_STRING);
        $topicParent = filter_input(INPUT_POST, 'parent-theme', FILTER_SANITIZE_STRING);
        $topicImage = $_FILES['image']['name'];
        
        if($topicParent != 0){
            // Neuen Topic in Datenbank schreiben
            try {
                // Startet die Warteschleife
                $this->db->beginTransaction();
                /*
                 * START Queries
                 */

                // Thema speichern
                $query = $this->db->prepare("INSERT INTO topics (link, name, theme_id, teaser, image, status) VALUES (:link, :name, :theme_id, :teaser, :image, :status)");
                $save = $query->execute(array(
                    ':link' => self::clearString($topicTitle),
                    ':name' => $topicTitle,
                    ':theme_id' => $topicParent,
                    ':teaser' => $topicTeaser,
                    ':image' => $topicImage,
                    ':status' => 1
                ));
                
                $query = $this->db->prepare("SELECT link FROM themes WHERE id = $topicParent");
                $select = $query->execute();
                $themeLink = $query->fetch(FETCH_MODE);

                // Theme last_update aktualisieren
                parent::themeUpdateLastUpdate($themeLink['link']);
                
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
        
        return false;
        
        
        
        
    }
}