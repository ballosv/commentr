<?php

class Login_Model extends Model{

    function __construct() {
        parent::__construct();
        Debug::addMsg('Login_Model wurde geladen');
        
    }
    
    public function checkLogin($username, $password){
        // User aus der Datenbank auslesen
        $query = $this->db->prepare("SELECT id, name, pass, role FROM users WHERE name = :username");
        $query->execute(array(
            ':username' => $username
        ));
        // Datensätze erstellen
        $data = $query->fetch();
        // Anzahl der Datensätze auslesen
        $rowCount = $query->rowCount();
        
        if($rowCount > 0){
            // Passwort prüfen
            if(password_verify($password, $data['pass']) === TRUE){
                Session::init();
                Session::set('login_status', true);
                Session::set('name', $data['name']);
                Session::set('user_id', $data['id']);
                
                // Admin Login
                if($data['role'] == 1){
                    Session::set('user_role', 1);
                }
                
                // User Login
                if($data['role'] == 0){
                    Session::set('user_role', 0);
                }
                
                return true;
            }
            else{
                return false;
            }
        }else{
            return 'error';
        }   
    }
    
    public function logout(){
        Session::destroy();
    }

}