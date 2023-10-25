<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Checklist Tracker</title>

    <script>
    //funcion con ajax
    //funcion para evitar que cambie de direccion de screen
        function submitForm() {
            const formData = new FormData(document.getElementById('task-form')); //se crea para poder manejar
            fetch('class/procesaform.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert("Tarea creada correctamente"+data); // Muestra el mensaje de respuesta del servidor
                hideTaskModal(); // Oculta el modal después de enviar el formulario
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</head>

<body>
<body>

    <!-- Header -->
    <header>
        <!-- Icono de Menú -->
        <div class="menu-icon" onclick="toggleDrawer()">
            &#9776;
        </div>
        <!-- Logo y Titulo del App -->
        <img
            src="./assets/logo.png"
            alt="CheckList Tracker"
            class="logo"
        >
        <h1>CheckList Manager</h1>
    </header>

    <!-- Drawer (contenido oculto) -->
    <div class="overlay" onclick="closeDrawer()"></div>
    <div class="drawer" id="drawer">
        <a href="#" class="drawer-item" onclick="handleDrawerItemClick(event)">Opción 1</a>
        <a href="#" class="drawer-item" onclick="handleDrawerItemClick(event)">Opción 2</a>
        <a href="#" class="drawer-item" onclick="handleDrawerItemClick(event)">Opción 3</a>
    </div>

    <!-- Contenido del Checklist -->
    <div class="container">
        <div class="columns">
            <!-- Por Hacer -->
            <div class="column">
                <div class="add-task-button" onclick="showTaskForm()">
                    <h3>Por Hacer</h3>
                    <div class="add-sign">
                        &#43;
                    </div>
                </div>
                <ul id="todo-tasks">
                    <!-- Contenido se crea a partir del modal -->
                </ul>
            </div>
            <!-- En Progreso -->
            <div class="column">
                <div class="title-margin" onclick="showTaskForm()">
                    <h3>En Progreso</h3>
                </div>
                <ul id="in-progress-tasks">
                    <!-- Contenido se crea a partir del modal -->
                </ul>
            </div>
            <!-- Terminadas -->
            <div class="column">
                <div class="title-margin" onclick="showTaskForm()">
                    <h3>Terminadas</h3>
                </div>
                <ul id="completed-tasks">
                    <!-- Contenido se crea a partir del modal -->
                </ul>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-overlay" onclick="hideTaskModal()"></div>
        <div class="modal" id="task-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Contenido del modal -->
                    <h2 id="modal-title">Agregar Nueva Tarea</h2>
                    <span class="close-modal" onclick="hideTaskModal()">&times;</span> <!-- Icono para cerrar el modal -->
                </div>
                <!-- form -->
                <form id="task-form" method="POST" action="class/procesaform.php" onsubmit="submitForm(); return false;">
                    <label for="task-title">Título:</label>
                    <input type="text" id="task-title" name="task-title" required><br>

                    <label for="task-description">Descripción:</label>
                    <textarea id="task-description" name="task-description" required></textarea><br>

                    <label for="task-status">Estado:</label>
                    <select id="task-status" name="task-status" required>
                        <option value="Por Hacer">Por Hacer</option>
                        <option value="En Progreso">En Progreso</option>
                        <option value="Terminadas">Terminadas</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select><br>

                    <label for="task-due-date">Fecha de Compromiso:</label>
                    <input type="date" id="task-due-date" name="task-due-date" required><br>

                    <label for="task-edited">Editado:</label>
                    <input type="checkbox" id="task-edited" name="task-edited" disabled><br>

                    <label for="task-assignee">Responsable:</label>
                    <input type="text" id="task-assignee" name="task-assignee" required><br>

                    <label for="task-type">Tipo de Tarea:</label>
                    <select id="task-type" name="task-type" required>
                        <!-- AÑADIRA SELECCIONAR TAREA COMO TEXTO INICIAL -->
                        <option value="P1 - Urgente">P1 - Urgente</option>
                        <option value="P2 - Moderado">P2 - Moderado</option>
                        <option value="P3 - No Urgente">P3 - No Urgente</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select><br>

                    <button type="submit" id="task-submit-button">Agregar Tarea</button>
                    <button onclick="hideTaskModal()">Cancelar</button>
                </form>
            </div>
        </div>

        <!-- <div class="additional-cards">
            <div class="card">
                <h2>Reporte</h2>
                <select id="report-type">
                    <option value="tipo">Por Tipo de Tarea</option>
                    <option value="estado">Por Estado</option>
                    <option value="dia">Por Día</option>
                    <option value="semana">Por Semana</option>
                    <option value="mes">Por Mes</option>
                    <option value="anio">Por Año</option>
                </select>
                <button id="generate-report">Generar Reporte</button>
                <ul id="report-results"></ul>
            </div>
        </div> -->

    </div>

    <script src="./js/script.js"></script>
</body>

</html>