<?php

class Register_Model extends Model{

    function __construct() {
        parent::__construct();
        Debug::addMsg('Register_Model wurde geladen');
        
    }
    
    public function createUser($name, $mail, $pass) {
        
        $hash = hash('SHA512', uniqid());
        
        $hashedPassword = hash('SHA512', $pass . $hash);
        
        $query = $this->db->prepare('INSERT INTO '
                . 'users(name,email,pass,hash,role,newsletter) '
                . 'VALUES(:name, :email, :pass, :hash, :role, :newsletter)');
        
        $result = $query->execute(array(
            ':name' => $name,
            ':email' => $mail,
            ':pass' => $hashedPassword,
            ':hash' => $hash,
            ':role' => 0,
            ':newsletter' => 1
        ));
        
    }
    
    public function userExist($name) {
        
        $query = $this->db->prepare('SELECT id FROM users WHERE name = :name');
        
        $result = $query->execute( array( $name ) );
        
        $affectedRow;
        
    }

}