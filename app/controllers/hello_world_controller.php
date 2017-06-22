<?php

class HelloWorldController extends BaseController {

    public static function index() {
        View::make('index.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
    }

}
