<?php

class UserController extends BaseController {

    public static function edit() {

        $user = parent::get_user_logged_in();
        View::make('user_edit.html', array('attributes' => $user));
    }

    public static function update() {

        $params = $_POST; // post params from edit view
        $user = User::find($params['id']);

        if (strcmp($params['password1'], $params['password2']) != 0) {
            Redirect::to('/edit_user', array('attributes' => $user, 'error' => 'Salasanat eivät täsmää'));
        }

        $user->username = $params['username'];
        $user->password = $params['password1'];

        $errors = $user->validateParams();
        if (count($errors) > 0) {
            Redirect::to('/edit_user', array('errors' => $errors));
        }

        $user->update();
        Redirect::to('/show_user', array('success' => 'Muokkaus onnistui'));
    }

    public static function create() {

        View::make('user_new.html');
    }

    public static function store() {

        $params = $_POST;

        if (strcmp($params['password1'], $params['password2']) != 0) {
            View::make('user_new.html', array('error' => 'Salasanat eivät täsmää'));
        }

        $user = new User(array(
            'username' => $params['username'],
            'password' => $params['password1']
        ));

        $errors = $user->validateParams();
        if (count($errors) > 0) {
            View::make('user_new.html', array('errors' => $errors));
        }

        $user->save();

        Redirect::to('/login', array('message' => 'Onnistui! Kirjaudu sisään uudella tililläsi'));
    }

    public static function delete() {

        $user = parent::get_user_logged_in();
        Memo::deleteMemosWithUser($user->id);
        $user->delete();
        Redirect::to('/login', array('message' => 'Käyttäjätilisi on poistettu'));
    }

    public static function show() {

        $user = parent::get_user_logged_in();

        View::make('user_show.html', array('attributes' => $user));
    }

}
