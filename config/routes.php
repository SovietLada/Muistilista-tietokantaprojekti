<?php

$routes->get('/hiekkalaatikko', function() {

    MemoController::sandbox();
});

$routes->get('/', function() {

    MemoController::index();
});

$routes->get('/categories', function() {

    MemoController::categories();
});

$routes->post('/', function() {

    MemoController::store();
});

$routes->get('/new', function() {

    MemoController::create();
});

$routes->get('/:id', function($id) {

    MemoController::edit($id);
});

$routes->post('/:id', function() {
   
    MemoController::update();
});

$routes->get('/delete/:id', function($id) {

    MemoController::delete($id);
});

$routes->get('/show/:id', function($id) {
   
    MemoController::show($id);
});