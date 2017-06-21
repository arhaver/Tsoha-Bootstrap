<?php

class HelloWorldController extends BaseController {

    public static function index() {
        View::make('index.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $errors = array();
        $date_min = date_create("now");
        $examdate = date_create_from_format('d/m/Y', '25/05/2017');

        if (!$examdate) {
            $errors[] = 'Päivämäärän tulee olla muodossa dd/mm/yyyy!';
        }
        elseif ($date_min > $examdate){
            $errors[] = 'Tentin päivämäärän pitää olla tulevaisuudessa!';
        }
        
        Kint::dump($errors);
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
