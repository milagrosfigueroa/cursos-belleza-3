"use strict"

const BASE_URL = "api/"; // url relativa a donde estoy parado (http://localhost/web2/2024/todo-list-rest/api)

// arreglo de tareas
let courses = [];

// event listener para insertar tarea
let form = document.querySelector("#course-form");
form.addEventListener('submit', insertCourse);


async function getAllCourses() {
    try {
        const response = await fetch(BASE_URL + "cursos");
        if (!response.ok) {
            throw new Error('Error al llamar los cursos');
        }

        courses = await response.json();
        showCourses();
    } catch(error) {
        console.log(error)
    }
}

async function insertCourse(e) {
    e.preventDefault();

    let data = new FormData(form);
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
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(course)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nCourse = await response.json();

        // inserto la tarea nueva
        courses.push(nCourse);
        showCourses();

        form.reset();
    } catch(e) {
        console.log(e);
    }
}

async function deleteCourse(e) {
    e.preventDefault();

    try {
        let id = e.target.dataset.course;
        let response = await fetch(BASE_URL + 'cursos/' + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        courses = courses.filter(courses => course.id != id);
        showCourses();
    } catch(e) {
        console.log(e);
    }
}

function showCourses() {
    let ul = document.querySelector("#course-list");
    ul.innerHTML = "";
    for (const course of courses) {
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


    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteCourse);
    }

}


getAll();
