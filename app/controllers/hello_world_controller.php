<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('suunnitelmat/index.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function exam_list() {
        View::make('suunnitelmat/exam_list.html');
    }

    public static function exam_show() {
        View::make('suunnitelmat/exam_show.html');
    }

    public static function exam_edit() {
        View::make('suunnitelmat/exam_edit.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
