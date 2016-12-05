<?php

class Category extends BaseModel {

    // atrributes
    public $id, $title;

    // constructor
    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function all() {

        // init query
        $query = DB::connection()->prepare('SELECT * FROM Category');
        // execute query
        $query->execute();
        // fetch results
        $rows = $query->fetchAll();
        $categories = array();

        foreach ($rows as $row) {

            $categories[] = new Category(array(
                'id' => $row['id'],
                'title' => $row['title'],
            ));
        }

        return $categories;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $category = new Category(array(
                'id' => $row['id'],
                'title' => $row['title'],
            ));
            return $category;
        }
        return NULL;
    }

}
