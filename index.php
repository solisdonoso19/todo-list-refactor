<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('class/todo.php');
    $todo = new todo();
    $list = $todo->get();
    foreach ($list as $valor) {
        echo $valor['id'] . "<br>";
        echo $valor['titulo'] . "<br>";
        echo $valor['descripcion'] . "<br>";
        echo $valor['estado'] . "<br>";
        echo $valor['fecha'] . "<br>";
        echo $valor['editado'] . "<br>";
        echo $valor['responsable'] . "<br>";
        echo $valor['tipo_tarea'] . "<br>";
    }
    ?>
</body>

</html>