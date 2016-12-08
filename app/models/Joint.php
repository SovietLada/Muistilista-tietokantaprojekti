<?php

class Joint extends BaseModel {

    public $id, $memo_id, $category_id;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Joint WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $joint = new Joint(array(
                'id' => $row['id'],
                'memo_id' => $row['memo_id'],
                'category_id' => $row['category_id'],
            ));
            return $joint;
        }
        return NULL;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Joint (memo_id, category_id) VALUES (:memo_id, :category_id) RETURNING id');
        $query->execute(array('memo_id' => $this->memo_id, 'category_id' => $this->category_id));
        $row = $query->fetch();
    }

    public function update() {

        $query = DB::connection()->prepare('UPDATE Joint (memo_id, category_id) VALUES (:memo_id, :category_id) RETURNING id');
        $query->execute(array('memo_id' => $this->memo_id, 'category_id' => $this->category_id));
        $row = $query->fetch();
    }

    public function delete() {

        $query = DB::connection()->prepare('DELETE FROM Joint WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
    }

    public static function deleteJointsWithMemo($id) {

        $query = DB::connection()->prepare('SELECT * FROM Joint WHERE memo_id = :memo_id');
        $query->execute(array('memo_id' => $id));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {

            $joint = new Joint(array(
                'id' => $row['id'],
                'memo_id' => $id,
                'category_id' => $row['category_id'],
            ));
            $joint->delete();
        }
    }

}
