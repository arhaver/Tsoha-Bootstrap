<?php

class Exam extends BaseModel {

    public $id, $owner, $topic, $testdate, $testtime, $room, $tester, $publicity;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_topic', 'validate_date', 'validate_time');
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
        $query = DB::connection()->prepare('INSERT INTO Exam (topic, owner, testdate, testtime, room, tester) VALUES (:topic, :owner, :testdate, :testtime, :room, :tester) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'owner' => $owner, 'testdate' => $this->testdate, 'testtime' => $this->testtime, 'room' => $this->room, 'tester' => $this->tester));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_topic() {
        $errors = array();
        $topic_length_min = 3;
        $topic_length_max = 120;

        if (parent::string_is_empty($this->topic)) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (!parent::validate_string_length($this->topic, $topic_length_min)) {
            $errors[] = 'Nimen pitää olla vähintään ' . $topic_length_min . ' merkkiä!';
        }
        
        if (parent::validate_string_length($this->topic, $topic_length_max + 1)) {
            $errors[] = 'Nimi saa olla korkeintaan ' . $topic_length_max . ' merkkiä!';
        }

        return $errors;
    }
    
    public function validate_date(){
        $errors = array();
        $date_min = date_create("now");
        $examdate = date_create_from_format('d/m/Y', $this->testdate);

        if (parent::string_is_empty($this->testdate)) {
            $errors[] = 'Päivämäärä ei saa olla tyhjä!';
        }
        if (!$examdate) {
            $errors[] = 'Päivämäärän tulee olla muodossa dd/mm/yyyy';
        }
        elseif ($date_min > $examdate){
            $errors[] = 'Tentin päivämäärän pitää olla tulevaisuudessa!';
        }
        return $errors;
    }
    
    public function validate_time(){
        $errors = array();
        $examtime_max = date_create_from_format('H:i', '24:00');
        $examtime = date_create_from_format('H:i', $this->testtime);
        
        if (parent::string_is_empty($this->testtime)) {
            $this->testtime = '0:00';
        }elseif (!$examtime) {
            $errors[] = 'Ajan tulee olla muodossa hh:mm';
        }elseif ($examtime > $examtime_max) {
            $errors[] = 'Ajan tulee olla 0:00 ja 24:00 välillä!';
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
    
    public function addmaterial($material, $limitation, $pages){
        $query = DB::connection()->prepare('INSERT INTO ExamMaterial (exam, material, limitation, pages) VALUES (:exam, :material, :limitation, :pages)');
        $query->execute(array('exam' => $this->id, 'material' => $material, 'limitation' => $limitation, 'pages' => $pages));
    }
    
    public function findExamMaterials(){
        $query = DB::connection()->prepare('SELECT * FROM ExamMaterial INNER JOIN Material ON ExamMaterial.material = Material.id where exam = :id');
        $query->execute(array('id' => $this->id));
        $rows = $query->fetchAll();
        $exammaterials = array();

        foreach ($rows as $row) {
            $exammaterials[] = array(
                'exam' => $row['exam'],
                'material' => $row['material'],
                'limitation' => $row['limitation'],
                'pages' => $row['pages'],
                'topic' => $row['topic'],
                'writer' => $row['writer'],
                'kind' => $row['kind'],
                'lang' => $row['lang'],
                'info' => $row['info']
            );
        }

        return $exammaterials;
    }

}
