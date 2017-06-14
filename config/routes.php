<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/exam', function() {
    ExamController::exams();
});

$routes->post('/exam', function() {
    ExamController::store();
});

$routes->get('/exam/new', function() {
    ExamController::create();
});

$routes->get('/exam/:id', function($id) {
    ExamController::show($id);
});

$routes->get('/exam/:id/edit', function($id) {
    ExamController::edit($id);
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/testindex', function() {
    HelloWorldController::test_index();
});

$routes->get('/exam/:id/edit', function($id) {
    ExamController::edit($id);
});

$routes->post('/exam/:id/edit', function($id) {
    ExamController::update($id);
});

$routes->post('/exam/:id/destroy', function($id) {
    ExamController::destroy($id);
});

$routes->get('/login', function(){
  UserController::login();
});
$routes->post('/login', function(){
  UserController::handle_login();
});
