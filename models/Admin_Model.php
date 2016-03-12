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
        $themeParent = filter_input(INPUT_POST, 'parent-theme', FILTER_SANITIZE_STRING);
        $themeCategory = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        
        // Neues Thema in Datenbank schreiben und Kategorie abspeichern
        try {
            // Startet die Warteschleife
            $this->db->beginTransaction();
            /*
             * START Queries
             */
            
            // Thema speichern
            $query = $this->db->prepare("INSERT INTO themes (link, name, teaser, parent, status) VALUES (:link, :name, :teaser, :parent, :status)");
            $save = $query->execute(array(
                ':link' => self::clear_string($themeTitle),
                ':name' => $themeTitle,
                ':teaser' => $themeTeaser,
                ':parent' => $themeParent,
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
            $data = $query->fetchAll();
            
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

}