<?php

class Material extends BaseModel {

    public $id, $topic, $writer, $kind, $lang, $info;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_topic', 'validate_writer', 'validate_kind', 'validate_lang', 'validate_info');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Material');
        $query->execute();
        $rows = $query->fetchAll();
        $materials = array();

        foreach ($rows as $row) {
            $materials[] = new Material(array(
                'id' => $row['id'],
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Material (topic, writer, kind, lang, info) VALUES (:topic, :writer, :kind, :lang, :info) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'writer' => $this->writer, 'kind' => $this->kind, 'lang' => $this->lang, 'info' => $this->info));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Material WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function can_be_deleted(){
        $query = DB::connection()->prepare('SELCET * FROM ExamMaterial WHERE material = :material');
        $query->execute(array('material' => $this->id));
        $row = $query->fetch();
        
        if ($row) {
            return false;
        }
        
        return true;
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

    public function validate_writer() {
        $errors = array();
        $writer_length_max = 120;

        if (parent::validate_string_length($this->writer, $writer_length_max + 1)) {
            $errors[] = 'Kirjoittajien tiedot saavat olla korkeintaan ' . $writer_length_max . ' merkkiä!';
        }

        return $errors;
    }

    public function validate_kind() {
        $errors = array();
        $kind_length_max = 25;

        if (parent::validate_string_length($this->kind, $kind_length_max + 1)) {
            $errors[] = 'Tyyppi saa olla korkeintaan ' . $kind_length_max . ' merkkiä!';
        }

        return $errors;
    }

    public function validate_lang() {
        $errors = array();
        $lang_length_max = 25;

        if (parent::validate_string_length($this->lang, $lang_length_max + 1)) {
            $errors[] = 'Kieli saa olla korkeintaan ' . $lang_length_max . ' merkkiä!';
        }

        return $errors;
    }

    public function validate_info() {
        $errors = array();
        $info_length_max = 250;

        if (parent::validate_string_length($this->info, $info_length_max + 1)) {
            $errors[] = 'Muut tiedot saavat olla korkeintaan ' . $info_length_max . ' merkkiä!';
        }

        return $errors;
    }

}
