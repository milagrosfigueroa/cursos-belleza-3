"use strict"

const BASE_URL = "api/"; // url relativa a donde estoy parado (http://localhost/web2/2024/todo-list-rest/api)

// arreglo de tareas
let students = [];

// event listener para insertar tarea
let form = document.querySelector("#student-form");
form.addEventListener('submit', insertStudent);


async function getAllStudents() {
    try {
        const response = await fetch(BASE_URL + "alumnos");
        if (!response.ok) {
            throw new Error('Error al llamar los alumnos');
        }

        students = await response.json();
        showStudents();
    } catch(error) {
        console.log(error)
    }
}

async function insertStudent(e) {
    e.preventDefault();

    let data = new FormData(form);
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
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(student)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nStudent = await response.json();

        // inserto la tarea nueva
        courses.push(nStudent);
        showStudents();

        form.reset();
    } catch(e) {
        console.log(e);
    }
}

async function deleteStudent(e) {
    e.preventDefault();

    try {
        let id = e.target.dataset.student;
        let response = await fetch(BASE_URL + 'alumnos/' + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        students = students.filter(courses => student.id != id);
        showStudents();
    } catch(e) {
        console.log(e);
    }
}

function showStudents() {
    let ul = document.querySelector("#student-list");
    ul.innerHTML = "";
    for (const student of students) {
        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ task.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${task.titulo}</b> - ${task.descripcion} (prioridad ${task.prioridad}) </span>
                <div class="ml-auto">
                    ${task.finalizada != 1 ? `<a href='#' data-task="${task.id}" type='button' class='btn btn-small btn-success btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-task="${task.id}" type='button' class='btn btn-small btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // actualizo el total
    let count = document.querySelector("#count");
    count.innerHTML = students.length;

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteStudent);
    }

}


getAll();
