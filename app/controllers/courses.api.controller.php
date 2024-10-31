<?php
require_once 'app/models/courses.model.php';
require_once 'app/views/json.view.php';

class CoursesApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CoursesModel();
        $this->view = new JSONView();
    }

    
    public function getAllCourses($req, $res) {
    
        $filtrarCategorias = null;
        if(isset($req->query->categoria)) {
            $filtrarCategorias = $req->query->categoria;
        }
        
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $courses = $this->model->getAllCourses($filtrarCategorias, $orderBy);
        
        return $this->view->response($courses);
    }


    
    public function getCourse($req, $res) {
        $id = $req->params->id;

        $course = $this->model->getCourse($id);

        if(!$course) {
            return $this->view->response("El curso con el id= $id no existe", 404);
        }
        return $this->view->response($course);
    }

    
    public function deleteCourse($req, $res) {
        $id = $req->params->id;

        $course = $this->model->getCourse($id);

        if (!$course) {
            return $this->view->response("el curso con el id= $id no existe", 404);
        }

        $this->model->eraseCourse($id);
        $this->view->response("el curso con el id= $id se eliminó con éxito");
    }

    public function createCourse($req, $res) {

        // valido los datos
        if (empty($req->body->nombre) || empty($req->body->descripcion) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $categoria = $req->body->categoria;
        $nombre = $req->body->nombre;       
        $descripcion = $req->body->descripcion;       
        $duracion = $req->body->duracion;
        $profesor = $req->body->profesor;
        $costo = $req->body->costo; 
        $imagen = $req->body->imagen;      

        // inserto los datos
        $id = $this->model->insertCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen);

        if (!$id) {
            return $this->view->response("Error al insertar tarea", 500);
        }

        // buena práctica es devolver el recurso insertado
        $course = $this->model->getCourse($id);
        return $this->view->response($course, 201);
    }
    public function updateCourse($req, $res) {
        $id = $req->params->id;

        // verifico que exista
        $course = $this->model->getCourse($id);
        if (!$course) {
            return $this->view->response("El curso con el id=$id no existe", 404);
        }

         // valido los datos
         if (empty($req->body->nombre) || empty($req->body->descripcion) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $categoria = $req->body->categoria;
        $nombre = $req->body->nombre;       
        $descripcion = $req->body->descripcion;       
        $duracion = $req->body->duracion;
        $profesor = $req->body->profesor;
        $costo = $req->body->costo; 
        $imagen = $req->body->imagen;    

        $this->model->updateCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen);

        $task = $this->model->getCourse($id);
        $this->view->response($task, 200);
    }

}
