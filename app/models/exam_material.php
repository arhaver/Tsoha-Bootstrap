<?php

class ExamMaterial extends BaseModel {

    public $exam, $material, $limitation, $pages;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_id', 'validate_limitations', 'validate_pages');
    }
    
    public function validate_id() {
        $errors = array();
        
        $examMaterial = self::find($this->exam, $this->material);

        if (!$examMaterial == null) {
            $errors[] = 'Materiaali on jo liitetty tähän tenttiin.';
        }
        
        return $errors;
    }
    
    public function validate_limitations(){
        $errors = array();
        $limitation_length_max = 120;
        if (parent::validate_string_length($this->limitation, $limitation_length_max)) {
            $errors[] = 'Koealue saa olla korkeintaan ' . $limitation_length_max . ' merkkiä!';
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
    
    public static function find($exam, $material) {
        $query = DB::connection()->prepare('SELECT * FROM ExamMaterial WHERE exam = :exam AND material = :material');
        $query->execute(array('exam' => $$exam, 'material' => $material));
        $row = $query->fetch();

        if ($row) {
            $examMaterial = new ExamMaterial(array(
                'exam' => $exam,
                'material' => $material,
                'limitation' => $row['limitation'],
                'pages' => $row['pages']
            ));
            
            return $examMaterial;
        }
        
        return null;
    }

}