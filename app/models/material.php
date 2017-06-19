<?php

class Material extends BaseModel {

    public $id, $owner, $topic, $writer, $kind, $lang, $info;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_topic');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Material');
        $query->execute();
        $rows = $query->fetchAll();
        $materials = array();

        foreach ($rows as $row) {
            $materials[] = new Material(array(
                'id' => $row['id'],
                'owner' => $row['owner'],
                'topic' => $row['topic'],
                'writer' => $row['writer'],
                'kind' => $row['kind'],
                'lang' => $row['lang'],
                'info' => $row['info']
            ));
        }

        return $materials;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Material WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $material = new Material(array(
                'id' => $row['id'],
                'owner' => $row['owner'],
                'topic' => $row['topic'],
                'writer' => $row['writer'],
                'kind' => $row['kind'],
                'lang' => $row['lang'],
                'info' => $row['info']
            ));

            return $material;
        }

        return null;
    }

    public function save($owner) {
        $query = DB::connection()->prepare('INSERT INTO Material (topic, owner, writer, kind, lang, info) VALUES (:topic, :writer, :kind, :lang, :info) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'owner' => $owner, 'writer' => $this->writer, 'kind' => $this->kind, 'lang' => $this->lang, 'info' => $this->info));
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
        $query = DB::connection()->prepare('DELETE FROM Material WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Material SET topic = :topic, writer = :writer, kind = :kind, lang = :lang, info = :info WHERE id = :id');
        $query->execute(array('topic' => $this->topic, 'writer' => $this->writer, 'kind' => $this->kind, 'lang' => $this->lang, 'info' => $this->info, 'id' => $this->id));
        $row = $query->fetch();
    }

    public static function find_by_topic($topic) {
        $query = DB::connection()->prepare('SELECT * FROM Material WHERE topic = :topic LIMIT 1');
        $query->execute(array('topic' => $topic));
        $row = $query->fetch();

        if ($row) {
            $material = new Material(array(
                'id' => $row['id'],
                'owner' => $row['owner'],
                'topic' => $row['topic'],
                'writer' => $row['writer'],
                'kind' => $row['kind'],
                'lang' => $row['lang'],
                'info' => $row['info']
            ));

            return $material;
        }

        return null;
    }

}