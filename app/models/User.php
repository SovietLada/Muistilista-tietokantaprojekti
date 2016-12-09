<?php

class User extends BaseModel {

    public $id, $username, $password;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM UserAccount WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ));

            return $user;
        }

        return NULL;
    }

    public function authenticate($username, $password) {

        $query = DB::connection()->prepare('SELECT * FROM UserAccount WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ));

            return $user;
        }
        return null;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO UserAccount (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $row = $query->fetch();

        return $row;
    }

    public function update() {

        $query = DB::connection()->prepare('UPDATE UserAccount SET username = :username, password = :password WHERE id = :id');
        $query->execute(array('username' => $this->username, 'password' => $this->password, 'id' => $this->id));
        $row = $query->fetch();
    }

    public function delete() {

        $query = DB::connection()->prepare('DELETE FROM UserAccount WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();

    }

    // Check both params and their respective conditions
    public function validateParams() {

        // TODO: implementation
    }

}
