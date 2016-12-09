<?php

class UserController extends BaseController {

    public static function login() {

        View::make('login.html');
    }

    public static function handle_login() {

        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
        }
    }

    public static function get_user_logged_in() {

        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            $user = User::find($user_id);

            return $user;
        }

        return null; // login failed
    }

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
        $user->delete();
        Redirect::to('/login', array('message' => 'Käyttäjätilisi on poistettu'));
    }

    public static function show() {

        $user = parent::get_user_logged_in();

        View::make('user_show.html', array('attributes' => $user));
    }

}
