<?php

require 'app/models/game.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $esimtest = Exam::find(1);
        $exams = Exam::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($exams);
        Kint::dump($esimtest);
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

    public static function test_index() {
        View::make('suunnitelmat/index.html');
    }

}
