<?php

class Memo extends BaseModel {

    // atrributes
    public $id, $title, $content, $priority, $user_id;

    // constructor
    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function allFromUser($user) {

        // init query
        $query = DB::connection()->prepare('SELECT * FROM Memo WHERE user_id = :uid');
        // execute query
        $query->execute(array('uid' => $user->id));
        // fetch results
        $rows = $query->fetchAll();
        $memos = array();

        foreach ($rows as $row) {

            $memos[] = new Memo(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'priority' => $row['priority'],
                'user_id' => $row['user_id']
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
                'user_id' => $row['user_id']
            ));
            return $memo;
        }
        return NULL;
    }

    public static function findMemosByCategory($id, $uid) {

        $query = DB::connection()->prepare('SELECT m.* FROM Joint j, Memo m WHERE j.category_id = :category_id AND m.id = j.memo_id AND m.user_id = :uid');
        $query->execute(array('category_id' => $id, 'uid' => $uid));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $memos = array();

        foreach ($result as $row) {

            $memo = new Memo(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'priority' => $row['priority'],
                'user_id' => $row['user_id']
            ));
            $memos[] = $memo;
        }

        return $memos;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Memo (title, content, priority, user_id) VALUES (:title, :content, :priority, :user_id) RETURNING id');
        $query->execute(array('title' => $this->title, 'content' => $this->content, 'priority' => $this->priority, 'user_id' => $this->user_id));
        $row = $query->fetch();

        return $row;
    }

    public function update() {

        $query = DB::connection()->prepare('UPDATE Memo SET title = :title, content = :content, priority = :priority, user_id = :user_id WHERE id = :id');
        $query->execute(array('title' => $this->title, 'content' => $this->content, 'priority' => $this->priority, 'user_id' => $this->user_id, 'id' => $this->id));
        $row = $query->fetch();
    }

    public function delete() {

        $query = DB::connection()->prepare('DELETE FROM Memo WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
    }

    // Check all three params and their respective conditions
    public function validateParams() { // TODO: Check input length
        $errors = array();

        $v1 = new Valitron\Validator(array('title' => $this->title));
        $v1->rule('required', 'title');
        if (!$v1->validate()) {
            $errors[] = 'Määrittele otsikko';
            $this->title = 'Otsikko';
        }

        $v2 = new Valitron\Validator(array('content' => $this->content));
        $v2->rule('required', 'content');
        if (!$v2->validate()) {
            $errors[] = 'Määrittele sisältö';
            $this->content = 'Sisältö';
        }

        $v3 = new Valitron\Validator(array('priority' => $this->priority));
        $v3->rule('numeric', 'priority');
        $v3->rule('required', 'priority');
        if (!$v3->validate()) {
            $errors[] = 'Prioriteetin tulee olla numeerinen arvo';
            $this->priority = 0;
        }

        return $errors;
    }

}
