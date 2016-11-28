<?php

class Memo extends BaseModel {

    // atrributes
    public $id, $title, $content, $priority;

    // constructor
    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function all() {

        // init query
        $query = DB::connection()->prepare('SELECT * FROM Memo');
        // execute query
        $query->execute();
        // fetch results
        $rows = $query->fetchAll();
        $memos = array();

        foreach ($rows as $row) {

            $memos[] = new Memo(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'priority' => $row['priority'],
            ));
        }

        return $memos;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Memo WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $memo = new Memo(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'priority' => $row['priority'],
            ));

            return $memo;
        }

        return NULL;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Memo (title, content, priority) VALUES (:title, :content, :priority) RETURNING id');
        $query->execute(array('title' => $this->title, 'content' => $this->content, 'priority' => $this->priority));
        $row = $query->fetch();
    }
    
    // Check all three params and their respective conditions
    public function validateParams() {
        
        $errors = array();
        
        $v1 = new Valitron\Validator(array('title' => $this->title));
        $v1->rule('required', 'title');
        if (!$v1->validate()) {
            $errors[] = 'Määrittele otsikko';
        }
        
        $v2 = new Valitron\Validator(array('content' => $this->content));
        $v2->rule('required', 'content');
        if (!$v2->validate()) {
            $errors[] = 'Määrittele sisältö';
        }
        
        $v3 = new Valitron\Validator(array('priority' => $this->priority));
        $v3->rule('numeric', 'priority');
        $v3->rule('required', 'priority');
        if (!$v3->validate()) {
            $errors[] = 'Prioriteetin tulee olla numeerinen arvo';
        }
        
        return $errors;
    }
    
}
