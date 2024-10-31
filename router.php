<?php
require_once 'libs/router.php';
require_once 'app/controllers/courses.api.controller.php';
require_once 'app/controllers/students.api.controller.php';
require_once 'app/controllers/enrollment.api.controller.php';

 $router = new Router();

 #                  endpoint             verbo           controller             metodo
 $router->addRoute('cursos'      ,       'GET',     'CoursesApiController',   'getAllCourses');
 $router->addRoute('cursos/:id'  ,       'GET',     'CoursesApiController',   'getCourse');
 $router->addRoute('cursos/:id'  ,       'DELETE',  'CoursesApiController',   'deleteCourse');
 $router->addRoute('cursos/:id'  ,       'PUT',    'CoursesApiController',   'updateCourse');
 $router->addRoute('cursos'      ,       'POST',     'CoursesApiController',   'createCourse');

 $router->addRoute('alumnos'      ,      'GET',     'StudentsApiController',   'getAllStudents');
 $router->addRoute('alumnos/:id'  ,      'GET',     'StudentsApiController',   'getStudent'   );
 $router->addRoute('alumnos/:id'  ,      'DELETE',  'StudentsApiController',   'deleteStudent');
 $router->addRoute('alumnos/:id'  ,      'PUT',    'StudentsApiController',   'updateStudent');
 $router->addRoute('alumnos'      ,      'POST',     'StudentsApiController',   'createStudent');

 $router->addRoute('inscriptos',         'GET',     'EnrollmentApiController',   'getAllEnrolledStudents');
 $router->addRoute('inscriptos/:id',     'GET',     'EnrollmentApiController',   'getEnrolledStudentsByCourse');

 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
