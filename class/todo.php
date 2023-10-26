<?php
require_once('modelo.php');
class todo extends ModeloBD
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_por_hacer()
    {
        $query = "SELECT * FROM checklist WHERE estado='Por Hacer'";
        $consulta = $this->_DB->query($query);
        $res = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$res) {
            echo 'ERROR QUERY';
            return 'ERROR';
        } else {
            return $res;
            $res->close();
            $this->_DB->close();
        }
    }

    public function get_en_progreso()
    {
        $query = "SELECT * FROM checklist WHERE estado='En Progreso'";
        $consulta = $this->_DB->query($query);
        $res = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$res) {
            echo 'ERROR QUERY';
            return 'ERROR';
        } else {
            return $res;
            $res->close();
            $this->_DB->close();
        }
    }

    public function get_terminada()
    {
        $query = "SELECT * FROM checklist WHERE estado='Terminada'";
        $consulta = $this->_DB->query($query);
        $res = $consulta->fetch_all(MYSQLI_ASSOC);
        if (!$res) {
            echo 'ERROR QUERY';
            return 'ERROR';
        } else {
            return $res;
            $res->close();
            $this->_DB->close();
        }
    }

    public function edit($taskID, $taskTitle, $taskDescription, $taskStatus, $taskDueDate, $taskAssignee, $taskType)
    {
        //echo "Entro a insert_new()";
        $query = "UPDATE checklist
                SET titulo = '$taskTitle', descripcion = '$taskDescription', estado = '$taskStatus', fecha = '$taskDueDate', responsable = '$taskAssignee', tipo_tarea = '$taskType', editado = 1
                WHERE id = $taskID";
        $consulta = $this->_DB->query($query);
        // Ejecuta la consulta
        if ($consulta) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $this->_DB->error;
            return false; // Indica que hubo un error al ejecutar la consulta
        }
    }

    public function insert_new($taskTitle, $taskDescription, $taskStatus, $taskDueDate, $taskAssignee, $taskType)
    {
        //echo "Entro a insert_new()";
        $query = "INSERT INTO checklist (titulo, descripcion, estado, fecha, responsable, tipo_tarea) values ('$taskTitle', '$taskDescription', '$taskStatus', '$taskDueDate', '$taskAssignee', '$taskType')";
        $consulta = $this->_DB->query($query);
        // Ejecuta la consulta
        if ($consulta) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $this->_DB->error;
            return false; // Indica que hubo un error al ejecutar la consulta
        }
    }

    public function delete($id)
    {
        //echo "Entro a insert_new()";
        $query = " DELETE FROM checklist WHERE id = $id;
";
        $consulta = $this->_DB->query($query);
        // Ejecuta la consulta
        if ($consulta) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $this->_DB->error;
            return false; // Indica que hubo un error al ejecutar la consulta
        }
    }
}
