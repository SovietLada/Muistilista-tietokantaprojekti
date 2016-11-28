<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MemoController extends BaseController {

    public static function sandbox() {

        View::make('helloworld.html');
    }

    public static function index() {

        $memos = Memo::all(); // get memos
        View::make('home.html', array('memos' => $memos)); // render view
    }

    public static function categories() {

        View::make('categories.html');
    }

    public static function create() {

        View::make('new.html');
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

}
