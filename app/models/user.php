<?php

class User extends BaseModel {

    public $id, $username, $password, $teacher;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_password');
    }

    public static function authenticate($username, $password) {

        $query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'teacher' => $row['teacher']
            ));

            return $user;
        } else {
            return NULL;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new Exam(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'teacher' => $row['teacher']
            ));

            return $user;
        }

        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Person (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function validate_username(){
        $errors = array();
        $username_length_min = 3;
        $username_length_max = 25;
        
        if (parent::string_is_empty($this->username)) {
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä!';
        }
        if (!parent::validate_string_length($this->username, $username_length_min)) {
            $errors[] = 'Käyttäjätunnuksen pitää olla vähintään ' . $username_length_min . ' merkkiä!';
        }
        
        if (parent::validate_string_length($this->username, $username_length_max + 1)) {
            $errors[] = 'Käyttäjätunnus saa olla korkeintaan ' . $username_length_max . ' merkkiä!';
        }

        return $errors;
    }
    
    public function validate_password(){
        $errors = array();
        $password_length_min = 6;
        $password_length_max = 25;
        
        if (parent::string_is_empty($this->password)) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        if (!parent::validate_string_length($this->password, $password_length_min)) {
            $errors[] = 'Salasanan pitää olla vähintään ' . $password_length_min . ' merkkiä!';
        }
        
        if (parent::validate_string_length($this->password, $password_length_max + 1)) {
            $errors[] = 'Salasana saa olla korkeintaan ' . $password_length_max . ' merkkiä!';
        }

        return $errors;
    }

}
