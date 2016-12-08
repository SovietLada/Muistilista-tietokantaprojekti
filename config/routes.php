<?php

function check_logged_in(){
  BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() { // home page

    MemoController::index();
});

$routes->get('/categories', 'check_logged_in', function() { // categories page

    MemoController::categories();
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

    UserController::login();
});
$routes->post('/login', function() { // log user in

    UserController::handle_login();
});

$routes->post('/logout', function() { // log user out
  
    UserController::logout();
});

$routes->get('/view_categories/:id', 'check_logged_in', function($id) { // show category page

    CategoryController::show($id);
});

$routes->get('/edit_user/:id', 'check_logged_in', function($id) { // edit user

    UserController::edit($id);
});

$routes->get('/new_user', 'check_logged_in', function() { // new user

    UserController::create();
});

$routes->get('/show_user/:id', 'check_logged_in', function($id) { // show user

    UserController::show($id);
});