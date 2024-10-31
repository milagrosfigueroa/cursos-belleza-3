<?php

class CoursesModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_cursos_belleza;charset=utf8', 'root', '');
    }
 
    public function getAllCourses($filtrarCategorias = null, $orderBy = false) {
        $sql = 'SELECT * FROM cursos';
    
        if($filtrarCategorias != null) {
            $sql .= ' WHERE categoria = :categoria';
        }
    
        if($orderBy) {
            switch($orderBy) {
                case 'categoria':
                    $sql .= ' ORDER BY categoria';
                    break;
            }
        }
    
        $query = $this->db->prepare($sql);

        if($filtrarCategorias != null) {
            $query->bindValue(':categoria', $filtrarCategorias, PDO::PARAM_STR);
        }
    
        $query->execute();

        $tasks = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $tasks;
    }
    
 
    public function getCourse($id) {    
        $query = $this->db->prepare('SELECT * FROM cursos WHERE ID_curso = ?');
        $query->execute([$id]);   
    
        $course = $query->fetch(PDO::FETCH_OBJ);
    
        return $course;
    }
 
    public function insertCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen) { 
        $query = $this->db->prepare('INSERT INTO cursos(categoria, nombre, descripcion, duracion, profesor, costo, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
    public function deleteInscriptionsByCourse($id) {
        $query = $this->db->prepare('DELETE FROM inscriptos WHERE ID_curso = ?');
        $query->execute([$id]);
    }
 
    public function eraseCourse($id) {
        $this->deleteInscriptionsByCourse($id);
        $query = $this->db->prepare('DELETE FROM cursos WHERE ID_curso = ?');
        $query->execute([$id]);
    }


    function updateCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id) {    
        $query = $this->db->prepare('UPDATE cursos SET categoria = ?, nombre = ?, descripcion = ?, duracion = ?, profesor = ?, costo= ?, imagen = ? WHERE ID_curso = ?');
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id]);
    }
}