
<?php
require_once('todo.php');
//echo "ENTRO A procesaform.php\n";
//echo '<script type="text/javascript">alert("ENTRO A procesaform.php");</script>';
if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST["task-title"]) && isset($_POST["task-description"])
    && isset($_POST["task-status"]) && isset($_POST["task-due-date"])
    && isset($_POST["task-assignee"]) && isset($_POST["task-type"])
) {

    $taskTitle = $_POST["task-title"];
    $taskDescription = $_POST["task-description"];
    $taskStatus = $_POST["task-status"];
    $taskDueDate = $_POST["task-due-date"];
    $taskAssignee = $_POST["task-assignee"];
    $taskType = $_POST["task-type"];
    $taskID = $_POST["task-id"];

    $obj_todo = new todo();
    $result = $obj_todo->edit($taskID, $taskTitle, $taskDescription, $taskStatus, $taskDueDate, $taskAssignee, $taskType);

    if ($result) {
        echo "Formulario procesado correctamente.";
    } else {
        echo "Hubo un error al procesar el formulario.";
    }
} else {
    echo "No se enviaron todos los datos del formulario.";
}
?>
