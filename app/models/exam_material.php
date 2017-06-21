<?php

class ExamMaterial extends BaseModel {

    public $exam, $material, $limitations, $pages;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_limitations', 'validate_pages');
    }
    
    public function validate_limitations(){
        $errors = array();
        $limitations_length_max = 120;
        if (parent::validate_string_length($this->limitations, $limitations_length_max)) {
            $errors[] = 'Koealue saa olla korkeintaan ' . $limitations_length_max . ' merkkiä!';
        }
        
        return $errors;
    }
    
    public function validate_pages() {
        $errors = array();
        
        if (parent::string_is_empty($this->pages)){
            $errors[] = 'Sivumäärä ei saa olla tyhjä!';
        }
        if ($this->pages < 1 ){
            $errors[] = 'Sivumäärän pitää olla positiivinen luku!';
        }
        
        return $errors;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO ExamMaterial (exam, material, limitation, pages) VALUES (:exam, :material, :limitation, :pages)');
        $query->execute(array('exam' => $this->exam, 'material' => $this->material, 'limitation' => $this->limitation, 'pages' => $this->pages));
    }

}