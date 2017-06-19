<?php

class ExamController extends BaseController {

    public static function exams() {
        self::check_logged_in();
        $exams = Exam::all($_SESSION['user']);
        View::make('exam/list.html', array('exams' => $exams));
    }

    public static function show($id) {
        self::check_logged_in();
        $exam = Exam::find($id);
        View::make('exam/show.html', array('exam' => $exam));
    }

    public static function edit($id) {
        self::check_logged_in();
        $exam = Exam::find($id);
        View::make('exam/edit.html', array('exam' => $exam));
    }

    public static function create() {
        self::check_logged_in();
        View::make('exam/new.html');
    }
    
    public static function addmaterial($id) {
        self::check_logged_in();
        $exam = Exam::find($id);
        $materials = Material::all();
        View::make('exam/addmaterial.html', array('exam' => $exam, 'materials' => $materials));
    }

    public static function store() {
        self::check_logged_in();
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

        if (count($errors) == 0) {
            $exam->save($_SESSION['user']);

            Redirect::to('/exam/' . $exam->id, array('message' => 'Tentti on lisätty kirjastoosi!'));
        } else {
            View::make('exam/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = (array(
            'id' => $id,
            'topic' => $params['topic'],
            'testdate' => $params['testdate'],
            'testtime' => $params['testtime'],
            'room' => $params['room'],
            'tester' => $params['tester']
        ));

        $exam = new Exam($attributes);
        $errors = $exam->errors();

        if (count($errors) == 0) {
            $exam->update();

            Redirect::to('/exam/' . $exam->id, array('message' => 'Tenttiä muokattu onnistuneesti!'));
        } else {
            View::make('exam/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $exam = new Exam(array('id' => $id));
        $exam->destroy();

        Redirect::to('/exam', array('message' => 'Tentti on poistettu onnistuneesti!'));
    }
    
    public static function linkmaterial($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $material = Material::find_by_topic($params['material']);
        $limitation = $params['limitations'];
        $pages = $params['pages'];
        
        $exam = Exam::find($id);
        $exam->addmaterial($material->id, $limitation, $pages);
    }

}
