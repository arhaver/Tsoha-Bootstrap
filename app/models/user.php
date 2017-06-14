<?php

class User extends BaseModel {

    public $id, $name, $password, $teacher;

    public function __construct($attributes) {
        parent::__construct($attributes);
//        $this->validators = array('validate_username');
    }

    public static function authenticate($name, $password) {

        $query = DB::connection()->prepare('SELECT * FROM Person WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'teatcher' => $row['teatcher']
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
                'name' => $row['name'],
                'password' => $row['password'],
                'teatcher' => $row['teacher']
            ));

            return $user;
        }

        return null;
    }

}
