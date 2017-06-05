<?php

class Exam extends BaseModel {

    public $id, $owner, $topic, $testdate, $testtime, $room, $tester, $publicity;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Exam');
        $query->execute();
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Exam (topic, testdate, testtime, room, tester) VALUES (:topic, :testdate, :testtime, :room, :tester) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'testdate' => $this->testdate, 'testtime' => $this->testtime, 'room' => $this->room, $this->tester));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
