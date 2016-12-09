<?php

class MemoController extends BaseController {

    public static function index() {

        $memos = Memo::allFromUser(parent::get_user_logged_in()); // get memos
        usort($memos, array("Memo", "cmp"));
        View::make('home.html', array('memos' => $memos)); // render view
    }

    public static function categories() {

        $categories = Category::all(); // get categories
        View::make('categories.html', array('categories' => $categories));
    }

    public static function create() {

        $categories = Category::all();
        View::make('memo_new.html', array('categories' => $categories));
    }

    public static function store() {
        // POST-req params are in $_POST
        $params = $_POST;
        // init new memo object
        $memo = new Memo(array(
            'title' => $params['title'],
            'content' => $params['content'],
            'priority' => $params['priority'],
            'user_id' => parent::get_user_logged_in()->id
        ));

        $errors = $memo->validateParams();
        if (count($errors) > 0) {
            $categories = Category::all();
            View::make('memo_new.html', array('errors' => $errors, 'attributes' => $memo, 'categories' => $categories)); // send multiple arrays to view
        }

        $newParams = $memo->save(); // save memo and get db entry with id

        $memoWithID = new Memo(array(
            'id' => $newParams['id'],
            'title' => $params['title'],
            'content' => $params['content'],
            'priority' => $params['priority']
        ));

        MemoController::setCategories($params, $memoWithID);

        Redirect::to('/', array('success' => 'Lisäys onnistui'));
    }

    public static function setCategories(array $params, $memo) {

        if (strcmp($params['CS'], 'on') == 0) {

            $category = Category::findByTitle('CS');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Kiireelliset'], 'on') == 0) {

            $category = Category::findByTitle('Kiireelliset');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Ei-kiireelliset'], 'on') == 0) {

            $category = Category::findByTitle('Ei-kiireelliset');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Sekalaiset'], 'on') == 0) {

            $category = Category::findByTitle('Sekalaiset');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Jonninjoutavat'], 'on') == 0) {

            $category = Category::findByTitle('Jonninjoutavat');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Tärkeät'], 'on') == 0) {

            $category = Category::findByTitle('Tärkeät');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Tietokantasovelluksen'], 'on') == 0) {

            $category = Category::findByTitle('Tietokantasovelluksen TODO-lista');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
        if (strcmp($params['Kissat'], 'on') == 0) {

            $category = Category::findByTitle('Kissat');
            $joint = new Joint(array(
                'memo_id' => $memo->id,
                'category_id' => $category->id
            ));

            $joint->save();
        }
    }

    public static function edit($id) {

        $memo = Memo::find($id);

        if ($memo->user_id != parent::get_user_logged_in()->id) {
            Redirect::to('/', array('error' => 'Sinulla ei ole oikeuksia muistion muokkaamiseen'));
        }

        $categories = Category::all();
        View::make('memo_edit.html', array('attributes' => $memo, 'categories' => $categories));
    }

    public static function update() {

        $params = $_POST; // post params from edit view
        $memo = Memo::find($params['id']);
        $memo->title = $params['title'];
        $memo->content = $params['content'];
        $memo->priority = $params['priority'];

        $errors = $memo->validateParams();
        if (count($errors) > 0) {
            $categories = Category::all();
            Redirect::to('/edit/' . $params['id'], array('errors' => $errors, 'categories' => $categories));
        }

        $memo->update();
        Joint::deleteJointsWithMemo($memo->id);
        self::setCategories($params, $memo);
        Redirect::to('/show/' . $memo->id, array('success' => 'Muokkaus onnistui'));
    }

    public static function delete($id) {

        $memo = Memo::find($id);

        if ($memo->user_id != parent::get_user_logged_in()->id) {
            Redirect::to('/', array('error' => 'Sinulla ei ole oikeuksia muistion poistamiseen'));
        }

        Joint::deleteJointsWithMemo($id);
        $memo->delete();
        Redirect::to('/', array('success' => 'Poisto onnistui'));
    }

    public static function show($id) {

        $memo = Memo::find($id);

        if ($memo->user_id != parent::get_user_logged_in()->id) {
            Redirect::to('/', array('error' => 'Sinulla ei ole oikeuksia muistion katseluun'));
        }

        View::make('memo_show.html', array('attributes' => $memo));
    }

}
