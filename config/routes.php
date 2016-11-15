<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/categories', function() {
    HelloWorldController::categories();
  });
  
  $routes->get('/memos', function() {
    HelloWorldController::memos();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
