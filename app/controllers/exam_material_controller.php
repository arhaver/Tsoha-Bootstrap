<?php

class ExamMaterialController extends BaseController {

    public static function store($id) {
        self::check_logged_in();
        $params = $_POST;

        $material = Material::find_by_topic($params['material']);

        $attributes = (array(
            'exam' => $id,
            'material' => $material->id,
            'limitations' => $params['limitations'],
            'pages' => $params['pages']
        ));

        $examMaterial = new ExamMaterial($attributes);
        $errors = $examMaterial->errors();

        if (count($errors) == 0) {
            $examMaterial->save();

            Redirect::to('/exam/' . $id, array('message' => 'Materiaali on liitetty tenttiin!'));
        } else {
            $exam = Exam::find($id);
            $materials = Material::all();
            View::make('exam/addmaterial.html', array('exam' => $exam, 'materials' => $materials, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function addmaterial($id) {
        self::check_logged_in();
        $exam = Exam::find($id);
        $materials = Material::all();
        View::make('exam/addmaterial.html', array('exam' => $exam, 'materials' => $materials));
    }

}
