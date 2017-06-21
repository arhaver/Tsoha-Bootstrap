<?php

class User extends BaseModel {

    public $id, $username, $password, $teacher;

    public function __construct($attributes) {
        parent::__construct($attributes);
//        $this->validators = array('validate_username');
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

}
