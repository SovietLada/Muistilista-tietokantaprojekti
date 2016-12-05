<?php

class MemoController extends BaseController {
    
    public static function index() {

        $memos = Memo::all(); // get memos
        View::make('home.html', array('memos' => $memos)); // render view
    }

    public static function categories() {

        $categories = Category::all(); // get categories
        View::make('categories.html', array('categories' => $categories));
    }

    public static function create() {

        View::make('memo_new.html');
    }

    public static function store() {
        // POST-req params are in $_POST
        $params = $_POST;
        // init new memo object
        $memo = new Memo(array(
            'title' => $params['title'],
            'content' => $params['content'],
            'priority' => $params['priority']
        ));

        $errors = $memo->validateParams();
        if (count($errors) > 0) {
            Redirect::to('/', array('errors' => $errors));
        }

        $memo->save();
        Redirect::to('/', array('success' => 'Lisäys onnistui'));
    }

    public static function edit($id) {

        $memo = Memo::find($id);
        View::make('memo_edit.html', array('attributes' => $memo));
    }
    
    public static function update() {
        
        $params = $_POST; // post params from edit view
        $memo = Memo::find($params['id']);
        $memo->title = $params['title'];
        $memo->content = $params['content'];
        $memo->priority = $params['priority'];
        
        $errors = $memo->validateParams();
        if (count($errors) > 0) {
            Redirect::to('/edit/' . $params['id'], array('errors' => $errors));
        }
        
        $memo->update();
        Redirect::to('/show/' . $memo->id, array('success' => 'Muokkaus onnistui'));
    }
    
    public static function delete($id) {
        
        $memo = Memo::find($id);
        $memo->delete();
        Redirect::to('/', array('success' => 'Poisto onnistui'));
    }
    
    public static function show($id) {
        
        $memo = Memo::find($id);
        View::make('memo_show.html', array('attributes' => $memo));
    }
}
