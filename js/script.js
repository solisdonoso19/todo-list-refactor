const drawer = document.getElementById('drawer');
const overlay = document.querySelector('.overlay');
const modal = document.getElementById('task-modal');
const addSign = document.querySelector('.add-sign');

// DRAWER
function toggleDrawer() {
    drawer.style.left = drawer.style.left === '0px' ? '-250px' : '0px';
    overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function closeDrawer() {
    drawer.style.left = '-250px';
    overlay.style.display = 'none';
}

// MODAL
function showTaskModal() {
    modal.style.display = 'flex';
}

function hideTaskModal() {
    modal.style.display = 'none';
}

addSign.addEventListener('click', showTaskModal);

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

function handleDrawerItemClick(event) {
    // Evita que el clic se propague hacia arriba (hacia el drawer y el overlay)
    event.stopPropagation();
}

// CONTENT
// Obtén el formulario y la lista "Por Hacer"
const taskForm = document.getElementById('task-form');
const todoTasksList = document.getElementById('todo-tasks');

taskForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    const taskTitle = document.getElementById('task-title').value;
    const taskDescription = document.getElementById('task-description').value;
    const taskStatus = document.getElementById('task-status').value;
    const taskDueDate = document.getElementById('task-due-date').value;
    const taskIsEdited = document.getElementById('task-edited').checked;
    const taskAssignee = document.getElementById('task-assignee').value;
    const taskType = document.getElementById('task-type').value;

    // Crea un nuevo elemento de tarjeta con etiquetas y valores del formulario
    const newCard = document.createElement('div');
    newCard.className = 'card';
    newCard.innerHTML = `
        <p><strong>Título:</strong> ${taskTitle}<br>
        <strong>Descripción:</strong> ${taskDescription}<br>
        <strong>Estado:</strong> ${taskStatus}<br>
        <strong>Fecha de Compromiso:</strong> ${taskDueDate}<br>
        <strong>Editado:</strong> ${taskIsEdited ? 'Sí' : 'No'}<br>
        <strong>Responsable:</strong> ${taskAssignee}<br>
        <strong>Tipo de Tarea:</strong> ${taskType}</p>
    `;

    // Agrega la nueva tarjeta a la lista de tareas por hacer
    todoTasksList.appendChild(newCard);

    // Oculta el modal
    hideTaskModal();
});