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

}
