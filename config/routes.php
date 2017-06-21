<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/testindex', function() {
    HelloWorldController::test_index();
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

$routes->post('/exam/:id/edit', function($id) {
    ExamController::update($id);
});

$routes->post('/exam/:id/destroy', function($id) {
    ExamController::destroy($id);
});

$routes->get('/exam/:id/addmaterial', function($id) {
    ExamMaterialController::addmaterial($id);
});

$routes->post('/exam/:id/addmaterial', function($id) {
    ExamMaterialController::linkmaterial($id);
});

$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->get('/material', function() {
    MaterialController::materials();
});

$routes->post('/material', function() {
    MaterialController::store();
});

$routes->get('/material/new', function() {
    MaterialController::create();
});

$routes->get('/material/:id', function($id) {
    MaterialController::show($id);
});

$routes->get('/material/:id/edit', function($id) {
    MaterialController::edit($id);
});

$routes->post('/material/:id/edit', function($id) {
    MaterialController::update($id);
});

$routes->post('/material/:id/destroy', function($id) {
    MaterialController::destroy($id);
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/register', function() {
    UserController::add_user();
});

$routes->post('/register', function() {
    UserController::store();
});
