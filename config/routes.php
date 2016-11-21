<?php

$routes->get('/', function() {
    MemoController::index();
});

$routes->get('/categories', function() {
    MemoController::categories();
});

$routes->get('/memos', function() {
    MemoController::memos();
});

$routes->get('/hiekkalaatikko', function() {
    MemoController::sandbox();
});

// muistion lisääminen tietokantaan
$routes->post('/', function() {
    MemoController::store();
});

// muistion lisäyslomakkeen näyttäminen
$routes->get('/new', function() {
    MemoController::create();
});

