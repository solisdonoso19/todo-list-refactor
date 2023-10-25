const drawer = document.getElementById('drawer');
const overlay = document.querySelector('.overlay');
const modal = document.getElementById('task-modal');
const addSign = document.querySelector('.add-sign');

// Obtén el formulario y la lista "Por Hacer"
const taskForm = document.getElementById('task-form');
const todoTasksList = document.getElementById('todo-tasks');
const modalTitle = document.getElementById('modal-title');

let isEditing = false; // Variable para rastrear si se está editando
let taskIdCounter = 1; // Un contador para asignar IDs únicos a las tarjetas
let currentEditedCard = null; // Variable para guardar la referencia a la tarjeta en modo de edición
const taskTitles = {}; // Objeto para almacenar los títulos de las tarjetas

// ************************************************************
// ************************ DRAWER ****************************
// ************************************************************

function toggleDrawer() {
    drawer.style.left = drawer.style.left === '0px' ? '-250px' : '0px';
    overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function closeDrawer() {
    drawer.style.left = '-250px';
    overlay.style.display = 'none';
}

// ************************************************************
// ************************ MODAL *****************************
// ************************************************************

function showTaskModal() {
    modal.style.display = 'flex';
}

function hideTaskModal() {
    modal.style.display = 'none';
    document.getElementById('task-form').reset(); // Restablece el formulario
    modalTitle.textContent = 'Agregar Nueva Tarea'; // Restablece el título del modal
    isEditing = false; // Restablece el estado de edición a falso

    // Cambia el texto del botón de vuelta a "Agregar Tarea"
    const submitButton = document.getElementById('task-submit-button');
    submitButton.textContent = 'Agregar Tarea';
}

// addSign.addEventListener('click', showTaskModal);

addSign.addEventListener('click', function() {
    isEditing = false; // Marca que no estamos en modo de edición
    showTaskModal();
});

// Cerrar el modal si se hace clic fuera de él
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        hideTaskModal();
    }
});

// Evitar que los clics dentro del modal cierren el modal
modal.addEventListener('click', function(event) {
    event.stopPropagation();
});

// Cerrar el modal si se hace clic fuera del drawer
overlay.addEventListener('click', function() {
    closeDrawer();
    hideTaskModal();
});

// ************************************************************
// ********************** CREACION ****************************
// ************************************************************

function createTask() {
    const taskTitle = document.getElementById('task-title').value;

    // Verifica si el título ya existe en las tarjetas creadas
    if (taskTitles[taskTitle] && !isEditing) {
        alert('¡El título de la tarea ya existe en otra tarjeta!');
        return;
    }

    const taskDescription = document.getElementById('task-description').value;
    const taskStatus = document.getElementById('task-status').value;
    const taskDueDate = document.getElementById('task-due-date').value;
    const taskIsEdited = document.getElementById('task-edited').checked;
    const taskAssignee = document.getElementById('task-assignee').value;
    const taskType = document.getElementById('task-type').value;

    // Crea un nuevo elemento de tarjeta si no estamos en modo de edición
    let newCard;
    if (!isEditing) {
        newCard = document.createElement('div');
        newCard.className = 'card';
        newCard.setAttribute('data-task-id', `task-${taskIdCounter}`);
        taskIdCounter++;
        // Agrega el taskTitle al registro de títulos de tarjetas
        taskTitles[taskTitle] = true;
    } else {
        // Si estamos en modo de edición, actualiza la tarjeta existente
        newCard = currentEditedCard;
        // Resetea la referencia a la tarjeta actual en modo de edición
        currentEditedCard = null;
    }

    newCard.innerHTML = `
        <img class="edit" src="./assets/edit.png" alt="editar">
        <img class="delete" src="./assets/delete.png" alt="eliminar">
        <p><strong>Título:</strong> ${taskTitle}<br>
        <strong>Descripción:</strong> ${taskDescription}<br>
        <strong>Estado:</strong> ${taskStatus}<br>
        <strong>Fecha de Compromiso:</strong> ${taskDueDate}<br>
        <strong>Editado:</strong> ${taskIsEdited ? 'Sí' : 'No'}<br>
        <strong>Responsable:</strong> ${taskAssignee}<br>
        <strong>Tipo de Tarea:</strong> ${taskType}</p>
    `;

    // Agrega la nueva tarjeta a la lista correspondiente según el estado seleccionado
    const targetList = getTargetTaskList(taskStatus);
    targetList.appendChild(newCard);

    // Agrega los event listeners nuevamente a los iconos de editar y eliminar en las columnas "En Progreso" y "Terminadas"
    if (taskStatus === 'En Progreso' || taskStatus === 'Terminadas') {
        newCard.querySelector('.edit').addEventListener('click', function() {
            const taskId = newCard.getAttribute('data-task-id');
            openEditModal(taskId);
        });

        newCard.querySelector('.delete').addEventListener('click', function() {
            newCard.remove();
        });
    }

    // Oculta el modal
    hideTaskModal();
}

function getTargetTaskList(status) {
    switch (status) {
        case 'Por Hacer':
            return document.getElementById('todo-tasks');
        case 'En Progreso':
            return document.getElementById('in-progress-tasks');
        case 'Terminadas':
            return document.getElementById('completed-tasks');
        default:
            return document.getElementById('todo-tasks'); // Columna Por Hacer como valor predeterminado
    }
}

// Asocia la función createTask al evento submit del formulario
taskForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe
    createTask();
});

// ************************************************************
// ********************** EDICION *****************************
// ************************************************************

function openEditModal(taskId) {
    // Obtén la tarjeta con el ID correspondiente
    const taskCard = document.querySelector(`[data-task-id="${taskId}"]`);

    // Guarda una referencia a la tarjeta actual en modo de edición
    currentEditedCard = taskCard;
    
    // Obtén los valores de la tarjeta para prellenar el formulario de edición
    const taskTitle = taskCard.querySelector('strong:nth-of-type(1)').nextSibling.textContent.trim();
    const taskDescription = taskCard.querySelector('strong:nth-of-type(2)').nextSibling.textContent.trim();
    const taskStatus = taskCard.querySelector('strong:nth-of-type(3)').nextSibling.textContent.trim();
    const taskDueDate = taskCard.querySelector('strong:nth-of-type(4)').nextSibling.textContent.trim();
    const taskIsEdited = taskCard.querySelector('strong:nth-of-type(5)').nextSibling.textContent.trim() === 'Sí';
    const taskAssignee = taskCard.querySelector('strong:nth-of-type(6)').nextSibling.textContent.trim();
    const taskType = taskCard.querySelector('strong:nth-of-type(7)').nextSibling.textContent.trim();

    // Llena el formulario de edición con los valores de la tarjeta
    document.getElementById('task-title').value = taskTitle;
    document.getElementById('task-description').value = taskDescription;
    document.getElementById('task-status').value = taskStatus;
    document.getElementById('task-due-date').value = taskDueDate;
    document.getElementById('task-edited').checked = taskIsEdited;
    document.getElementById('task-assignee').value = taskAssignee;
    document.getElementById('task-type').value = taskType;

    // Cambia el título del modal a 'Editar Tarea'
    modalTitle.textContent = 'Editar Tarea';
    // Marca que ahora estamos en modo de edición
    isEditing = true; 

    // Cambia el texto del botón según si estás en modo de edición o no
    const submitButton = document.getElementById('task-submit-button');
    submitButton.textContent = isEditing ? 'Editar Tarea' : 'Agregar Tarea';

    // Muestra el modal de edición
    showTaskModal();
}

// Asigna la función openEditModal al hacer clic en el icono de editar
todoTasksList.addEventListener('click', function(event) {
    const target = event.target;
    if (target.classList.contains('edit')) {
        const taskId = target.closest('.card').getAttribute('data-task-id');
        openEditModal(taskId);
    }

    if (target.classList.contains('delete')) {
        const taskCard = target.closest('.card');
        taskCard.remove();
    }
});
