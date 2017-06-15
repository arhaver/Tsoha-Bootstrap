<?php

class MaterialController extends BaseController {

    public static function materials() {
        $materials = Material::all($_SESSION['user']);
        View::make('material/list.html', array('materials' => $materials));
    }

    public static function show($id) {
        $material = Material::find($id);
        View::make('material/show.html', array('material' => $material));
    }

    public static function edit($id) {
        $material = Material::find($id);
        View::make('material/edit.html', array('material' => $material));
    }

    public static function store() {
        $params = $_POST;

        $attributes = (array(
            'topic' => $params['topic'],
            'writer' => $params['writer'],
            'kind' => $params['kind'],
            'lang' => $params['lang'],
            'info' => $params['info']
        ));

        $material = new Material($attributes);
        $errors = $material->errors();

        if (count($errors) == 0) {
            $material->save($_SESSION['user']);

            Redirect::to('/material/' . $material->id, array('message' => 'Materiaali on lisätty kirjastoon!'));
        } else {
            View::make('material/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = (array(
            'id' => $id,
            'topic' => $params['topic'],
            'writer' => $params['writer'],
            'kind' => $params['kind'],
            'lang' => $params['lang'],
            'info' => $params['info']
        ));

        $material = new Material($attributes);
        $errors = $material->errors();

        if (count($errors) == 0) {
            $material->update();

            Redirect::to('/material/' . $material->id, array('message' => 'Materiaalia muokattu onnistuneesti!'));
        } else {
            View::make('material/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        $material = new Material(array('id' => $id));
        $material->destroy();

        Redirect::to('/material', array('message' => 'Materiaali on poistettu onnistuneesti!'));
    }

    public static function create() {
        View::make('material/new.html');
    }

}
