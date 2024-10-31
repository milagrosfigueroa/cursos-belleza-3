<?php
require_once 'app/models/enrollment.api.model.php';
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
        
        if (!$students) {
            return $this->view->response("No hay estudiantes inscriptos en ningún curso", 404);
        }
        
        return $this->view->response($students);
    }
    

    public function getEnrolledStudentsBycourse($req, $res){
        if (!isset($req->params->id)) {
            return $this->view->response("ID de curso no especificado", 400);
        }
    
        $id = $req->params->id;
    
        $students = $this->model->getEnrolledStudentsByCourse($id);

        if (empty($students)) {
            return $this->view->response("No hay estudiantes inscriptos en este curso", 404);
        }
    
        return $this->view->response($students);
    }

}