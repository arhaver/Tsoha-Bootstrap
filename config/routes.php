<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/exam', function() {
  HelloWorldController::exam_list();
});

$routes->get('/exam/1', function() {
  HelloWorldController::exam_show();
});

$routes->get('/exam/1/edit', function() {
  HelloWorldController::exam_edit();
});

$routes->get('/login', function() {
  HelloWorldController::login();
});