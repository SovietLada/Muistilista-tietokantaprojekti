<?php

class User extends BaseModel {
    
    public $id, $username, $password;
    
    public function __construct($attributes) {
        
        parent::__construct($attributes);
    } 
    
        public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM UserAccount WHERE id = :id LIMIT 1'); // TODO: add table in db
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['title'],
                'password' => $row['content'],
            ));

            return $user;
        }

        return NULL;
    }
    
    public function authenticate($username, $password) {
        
        // TODO: Implementation
        
    }
}