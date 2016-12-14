<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() { // home page
    MemoController::index();
});

$routes->get('/categories', 'check_logged_in', function() { // categories page
    CategoryController::categories();
});

$routes->get('/view_categories/:id', 'check_logged_in', function($id) { // show category page
    CategoryController::show($id);
});

$routes->post('/', 'check_logged_in', function() { // add new memo
    MemoController::store();
});

$routes->get('/new', 'check_logged_in', function() { // new memo page
    MemoController::create();
});

$routes->get('/edit/:id', 'check_logged_in', function($id) { // edit memo page
    MemoController::edit($id);
});

$routes->post('/edit/:id', 'check_logged_in', function() { // update existing memo
    MemoController::update();
});

$routes->get('/delete/:id', 'check_logged_in', function($id) { // delete memo
    MemoController::delete($id);
});

$routes->get('/show/:id', 'check_logged_in', function($id) { // show memo page
    MemoController::show($id);
});

$routes->get('/login', function() { // login page
    BaseController::login();
});
$routes->post('/login', function() { // log user in
    BaseController::handle_login();
});

$routes->post('/logout', function() { // log user out
    BaseController::logout();
});

$routes->get('/edit_user', 'check_logged_in', function() { // edit user
    UserController::edit();
});

$routes->post('/edit_user', 'check_logged_in', function() { // update existing user
    UserController::update();
});

$routes->get('/new_user', function() { // new user page
    UserController::create();
});

$routes->post('/new_user', function() { // add new user
    UserController::store();
});

$routes->get('/show_user', 'check_logged_in', function() { // show user
    UserController::show();
});

$routes->get('/delete', 'check_logged_in', function() { // delete user
    UserController::delete();
});
