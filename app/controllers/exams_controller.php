<?php

class ExamController extends BaseController{
    public static function index(){
        $exams = Exam::all();
        View::make('exam/index.html', array('exams' => $exams));
    }
}

