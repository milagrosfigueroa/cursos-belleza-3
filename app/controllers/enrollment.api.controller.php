<?php
require_once 'app/models/enrollment.model.php';
require_once 'app/views/json.view.php';

class EnrollmentApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new EnrollmentModel();
        $this->view = new JSONView();
    }
 
    public function getAllEnrolledStudents($req, $res) {
        $students = $this->model->getAllEnrolledStudents();
        return $this->view->response($students);
    }

    public function getEnrolledStudentsBycourse(){
        if (!isset($req->params->idCurso)) {
            return $this->view->response("ID de curso no especificado", 400);
        }
    
        $idCurso = $req->params->idCurso;
    
        $students = $this->model->getEnrolledStudentsByCourse($idCurso);

        if (empty($students)) {
            return $this->view->response("No hay estudiantes inscriptos en este curso", 404);
        }
    
        return $this->view->response($students);
    }

}