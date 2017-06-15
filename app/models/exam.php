<?php

class Exam extends BaseModel {

    public $id, $owner, $topic, $testdate, $testtime, $room, $tester, $publicity;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_topic');
    }

    public static function all($owner) {
        $query = DB::connection()->prepare('SELECT * FROM Exam WHERE owner = :owner');
        $query->execute(array('owner' => $owner));
        $rows = $query->fetchAll();
        $exams = array();

        foreach ($rows as $row) {
            $exams[] = new Exam(array(
                'id' => $row['id'],
                'owner' => $row['owner'],
                'topic' => $row['topic'],
                'testdate' => $row['testdate'],
                'testtime' => $row['testtime'],
                'room' => $row['room'],
                'tester' => $row['tester'],
                'publicity' => $row['publicity']
            ));
        }

        return $exams;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Exam WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $exam = new Exam(array(
                'id' => $row['id'],
                'owner' => $row['owner'],
                'topic' => $row['topic'],
                'testdate' => $row['testdate'],
                'testtime' => $row['testtime'],
                'room' => $row['room'],
                'tester' => $row['tester'],
                'publicity' => $row['publicity']
            ));

            return $exam;
        }

        return null;
    }

    public function save($owner) {
        $query = DB::connection()->prepare('INSERT INTO Exam (topic, owner, testdate, testtime, room, tester) VALUES (:topic, :testdate, :testtime, :room, :tester) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'owner' => $owner, 'testdate' => $this->testdate, 'testtime' => $this->testtime, 'room' => $this->room, 'tester' => $this->tester));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_topic() {
        $errors = array();
        $topic_length_min = 3;

        if (parent::string_is_empty($this->topic)) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (!parent::validate_string_length($this->topic, $topic_length_min)) {
            $errors[] = 'Nimen pitää olla vähintään ' . $topic_length_min . ' merkkiä!';
        }

        return $errors;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Exam WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Exam SET topic = :topic, testdate = :testdate, testtime = :testtime, room = :room, tester = :tester WHERE id = :id');
        $query->execute(array('topic' => $this->topic, 'testdate' => $this->testdate, 'testtime' => $this->testtime, 'room' => $this->room, 'tester' => $this->tester, 'id' => $this->id));
        $row = $query->fetch();
    }

}
