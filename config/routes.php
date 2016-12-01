<?php

$routes->get('/hiekkalaatikko', function() { // sandbox

    MemoController::sandbox();
});

$routes->get('/', function() { // home page

    MemoController::index();
});

$routes->get('/categories', function() { // categories page

    MemoController::categories();
});

$routes->post('/', function() { // add new memo

    MemoController::store();
});

$routes->get('/new', function() { // new memo page

    MemoController::create();
});

$routes->get('/edit/:id', function($id) { // edit memo page

    MemoController::edit($id);
});

$routes->post('/edit/:id', function() { // update existing memo
   
    MemoController::update();
});

$routes->get('/delete/:id', function($id) { // delete memo

    MemoController::delete($id);
});

$routes->get('/show/:id', function($id) { // show memo page
   
    MemoController::show($id);
});

$routes->get('/login', function() { // login page

    UserController::login();
});
$routes->post('/login', function() { // log user in

    UserController::handle_login();
});