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

$routes->get('/exam/:id', function($id) {
    ExamController::show($id);
});

$routes->get('/exam/1/edit', function() {
    HelloWorldController::exam_edit();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/testindex', function() {
    HelloWorldController::test_index();
});
