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

    public static function store() {
        $params = $_POST;
        
        $exam = new Exam(array(
            'topic' => $params['topic'],
            'testdate' => $params['testdate'],
            'testtime' => $params[''],
            'room' => $params['room'],
            'tester' => $params['tester']
        ));
        
        $exam->save();
        
        Redirect::to('/exam/' . $exam->id, array('message' => 'Tentti on lisätty kirjastoosi!'));
    }

    public static function create() {
        View::make('exam/new.html');
    }

}

