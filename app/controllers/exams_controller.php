<?php

class ExamController extends BaseController {

    public static function exams() {
        self::check_logged_in();
        $exams = Exam::all($_SESSION['user']);
        $examMaterials = array();
        foreach ($exams as $exam) {
            $materials = $exam->findExamMaterials();
            $examMaterials = array_merge($examMaterials, $materials);
        }
        View::make('exam/list.html', array('exams' => $exams, 'examMaterials' => $examMaterials));
    }

    public static function show($id) {
        self::check_logged_in();
        $exam = Exam::find($id);
        $examMaterials = $exam->findExamMaterials();
        View::make('exam/show.html', array('exam' => $exam, 'examMaterials' => $examMaterials));
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

}
