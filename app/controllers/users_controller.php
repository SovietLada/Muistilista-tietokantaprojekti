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

    public static function edit($id) {

        View::make('user_edit.html');
    }

    public static function create() {

        View::make('user_new.html');
    }
    
    public static function show($id) {
        
        View::make('user_show.html');
    }

}
