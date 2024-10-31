<?php
require_once 'app/models/students.model.php';
require_once 'app/views/json.view.php';

class StudentsApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new StudentsModel();
        $this->view = new JSONView();
    }

    
    public function getAllStudents($req, $res) {
        $students = $this->model->getAllStudents();
        return $this->view->response($students);
    }


    
    public function getStudent($req, $res) {
        $id = $req->params->id;

        $student= $this->model->getStudent($id);

        if(!$student) {
            return $this->view->response("El alumno con el id= $id no existe", 404);
        }

        return $this->view->response($student);
    }

    
    public function deleteStudent($req, $res) {
        $id = $req->params->id;

        $student = $this->model->getStudent($id);

        if (!$student) {
            return $this->view->response("el alumno con el id= $id no existe", 404);
        }

        $this->model->eraseStudent($id);
        $this->view->response("el alumno con el id= $id se eliminó con éxito");
    }

    public function createStudent($req, $res) {

        if (empty($req->body->nombre) || empty($req->body->apellido) || empty($req->body->dni)|| empty($req->body->celular) || empty($req->body->domicilio)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;       
        $dni = $req->body->dni;       
        $celular = $req->body->celular;
        $domicilio = $req->body->domicilio;   

        $id = $this->model->insertStudent($nombre, $apellido, $dni, $celular, $domicilio);

        if (!$id) {
            return $this->view->response("Error al insertar alumno", 500);
        }

        $student = $this->model->getStudent($id);
        return $this->view->response($student, 201);
    }
    public function updateStudent($req, $res) {
        $id = $req->params->id;

        $student = $this->model->getStudent($id);
        if (!$student) {
            return $this->view->response("El alumno con el id=$id no existe", 404);
        }

         if (empty($req->body->nombre) || empty($req->body->apellido) || empty($req->body->dni)|| empty($req->body->celular) || empty($req->body->domicilio)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $apellido = $req->body->apellido;       
        $dni = $req->body->dni;       
        $celular = $req->body->celular;
        $domicilio = $req->body->domicilio; 

        $this->model->updateStudent($nombre, $apellido, $dni, $celular, $domicilio);

        $stuent = $this->model->getStudent($id);
        $this->view->response($student, 200);
    }

}
