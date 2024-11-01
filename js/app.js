"use strict";

const BASE_URL = "api/";

let students = [];
let courses = [];

let formStudent = document.querySelector("#student-form");
formStudent.addEventListener('submit', insertStudent);

let formCourse = document.querySelector("#course-form");
formCourse.addEventListener('submit', insertCourse);

async function getAllStudents() {
    try {
        const response = await fetch(BASE_URL + "alumnos");
        if (!response.ok) throw new Error('Error al llamar los alumnos');

        students = await response.json();
        showStudents(students);
    } catch (error) {
        console.error(error);
    }
}

async function getAllCourses() {
    try {
        const response = await fetch(BASE_URL + "cursos");
        if (!response.ok) throw new Error('Error al llamar los cursos');

        courses = await response.json();
        showCourses(courses);
    } catch (error) {
        console.error(error);
    }
}

async function insertStudent(e) {
    e.preventDefault();

    let data = new FormData(formStudent);
    let student = {
        nombre: data.get('nombre'),
        apellido: data.get('apellido'),
        dni: data.get('dni'),
        celular: data.get('celular'),
        domicilio: data.get('domicilio')
    };

    try {
        let response = await fetch(BASE_URL + "alumnos", {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(student)
        });
        if (!response.ok) throw new Error('Error del servidor');

        let nStudent = await response.json();
        students.push(nStudent);
        showStudents(students);
        formStudent.reset();
    } catch (e) {
        console.error(e);
    }
}

async function insertCourse(e) {
    e.preventDefault();

    let data = new FormData(formCourse);
    let course = {
        categoria: data.get('categoria'),
        nombre: data.get('nombre'),
        descripcion: data.get('descripcion'),
        duracion: data.get('duracion'),
        profesor: data.get('profesor'),
        costo: data.get('costo'),
        imagen: data.get('imagen')
    };

    try {
        let response = await fetch(BASE_URL + "cursos", {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(course)
        });
        if (!response.ok) throw new Error('Error del servidor');

        let nCourse = await response.json();
        courses.push(nCourse);
        showCourses(courses);
        formCourse.reset();
    } catch (e) {
        console.error(e);
    }
}

async function deleteStudent(e) {
    e.preventDefault();

    try {
        let id = e.target.dataset.alumno;
        let response = await fetch(BASE_URL + 'alumnos/' + id, { method: 'DELETE' });
        if (!response.ok) throw new Error('Recurso no existe');

        students = students.filter(student => student.ID_alumno != id);
        showStudents(students);
    } catch (e) {
        console.error(e);
    }
}

async function deleteCourse(e) {
    e.preventDefault();

    try {
        let id = e.target.dataset.curso;
        let response = await fetch(BASE_URL + 'cursos/' + id, { method: 'DELETE' });
        if (!response.ok) throw new Error('Recurso no existe');

        courses = courses.filter(course => course.ID_curso != id);
        showCourses(courses);
    } catch (e) {
        console.error(e);
    }
}

function showStudents(students) {
    let ul = document.querySelector("#student-list");
    ul.innerHTML = "";
    
    for (const student of students) {
        let html = `
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <span><b>${student.nombre} ${student.apellido}</b> - DNI: ${student.dni} - Celular: ${student.celular} - Domicilio: ${student.domicilio}</span>
                <div class="ml-auto">
                    <a href='#' data-alumno="${student.ID_alumno}" type='button' class='btn btn-small btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;
        ul.innerHTML += html;
    }

    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteStudent);
    }
}

function showCourses(courses) {
    let ul = document.querySelector("#course-list");
    ul.innerHTML = "";

    for (const course of courses) {
        let html = `
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <span><b>${course.nombre}</b> - ${course.descripcion} - Categoría: ${course.categoria} - Costo: $${course.costo} - Duración: ${course.duracion}</span>
                <div class="ml-auto">
                    <a href='#' data-curso="${course.ID_curso}" type='button' class='btn btn-small btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;
        ul.innerHTML += html;
    }

    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteCourse);
    }
}

// Llama a la función para cargar estudiantes y cursos
getAll();
