<?php

class StudentsModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_cursos_belleza;charset=utf8', 'root', '');
    }
 
    public function getAllStudents() {
        $query = $this->db->prepare('SELECT * FROM alumnos');
        $query->execute();

        $students = $query->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }
    
 
    public function getStudent($id) {    
        $query = $this->db->prepare('SELECT * FROM alumnos WHERE id = ?');
        $query->execute([$id]);   
    
        $students = $query->fetch(PDO::FETCH_OBJ);
    
        return $students;
    }
 
    public function insertStudent($nombre, $apellido, $dni, $celular, $domicilio) { 
        $query = $this->db->prepare('INSERT INTO alumnos(nombre, apellido, dni, celular, domicilio) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $apellido, $dni, $celular, $domicilio]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseStudent($id) {
        $query = $this->db->prepare('DELETE FROM alumnos WHERE id = ?');
        $query->execute([$id]);
    }


    function updateStudent($nombre, $apellido, $dni, $celular, $domicilio) {    
        $query = $this->db->prepare('UPDATE alumnos SET nombre = ?, apellido = ?, dni = ?, celular = ?, domicilio = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $dni, $celular, $domicilio]);
    }
}