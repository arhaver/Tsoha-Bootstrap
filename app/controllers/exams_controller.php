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
    
    public static function edit($id){
        $exam = Exam::find($id);
        View::make('exam/edit.html', array('exam' => $exam));
    }

    public static function store() {
        $params = $_POST;
        
        $attributes = (array(
            'topic' => $params['topic'],
            'testdate' => $params['testdate'],
            'testtime' => $params['testtime'],
            'room' => $params['room'],
            'tester' => $params['tester']
        ));
        
        $exam = new Exam($attributes);
        $errors = $exam->errors();
        
        if(count($errors) == 0){
            $exam->save();
        
            Redirect::to('/exam/' . $exam->id, array('message' => 'Tentti on lisätty kirjastoosi!'));
        } else{
            View::make('exam/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function update($id) {
        $params = $_POST;
        
        $attributes = (array(
            'id' => $id,
            'topic' => $params['topic'],
            'testdate' => $params['testdate'],
            'testtime' => $params['testtime'],
            'room' => $params['room'],
            'tester' => $params['tester']
        ));
        Kint::dump($params);
        
        $exam = new Exam($attributes);
        $errors = $exam->errors();
        
/*        if(count($errors) == 0){
            $exam->update();
        
            Redirect::to('/exam/' . $exam->id, array('message' => 'Tenttiä muokattu onnistuneesti!'));
        } else{
            View::make('exam/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }*/
    }
    
    public static function destroy($id){
        $exam = new Exam(array('id' => $id));
        $exam->destroy();
        
        Redirect::to('/exam', array('message' => 'Tentti on poistettu onnistuneesti!'));
    }

    public static function create() {
        View::make('exam/new.html');
    }

}

