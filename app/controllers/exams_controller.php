<?php

class ExamController extends BaseController{
    public static function exams(){
        $exams = Exam::all();
        View::make('exam/index.html', array('exams' => $exams));
    }
    
    public static function show($id){
        $exam = Exam::find($id);
        View::make('exam/show.html', array('exam' => $exam));
    }
}

