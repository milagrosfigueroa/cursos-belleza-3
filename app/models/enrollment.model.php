<?php

class EnrollmentModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_cursos_belleza;charset=utf8', 'root', '');
    }
 
    public function getAllEnrolledStudents() {
        $query = $this->db->prepare('SELECT * FROM inscriptos');
        $query->execute();

        $students = $query->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }
    public function getEnrolledStudentsByCourse($id){
        $sql = 'SELECT alumnos.ID_alumno, alumnos.nombre, alumnos.apellido 
                FROM inscriptos 
                JOIN alumnos ON inscriptos.ID_alumno = alumnos.ID_alumno 
                WHERE inscriptos.ID_curso = ?';

        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        // Obtiene los resultados
        $students = $query->fetchAll(PDO::FETCH_OBJ);

        return $students;
    }
}