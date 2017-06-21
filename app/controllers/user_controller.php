<?php

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('/', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/exam', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    public static function store() {
        $params = $_POST;

        $attributes = (array(
            'username' => $params['username'],
            'password' => $params['password']
        ));

        $user = new User($attributes);
//        $errors = $user->errors();

//        if (count($errors) == 0) {
            $user->save();

            Redirect::to('/', array('message' => 'Rekisteröityminen onnistui!'));
//        } else {
//            View::make('user/register.html', array('errors' => $errors, 'attributes' => $attributes));
//        }
    }

    public static function add_user() {
        View::make('user/register.html');
        
    }

}
