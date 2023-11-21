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
        $apiUrl = 'http://localhost/api/todo/leer-por-hacer.php';
        // Realiza la petición GET a la API y obtén la respuesta
        $response = file_get_contents($apiUrl);
        // Decodifica la respuesta JSON (si la API devuelve datos en formato JSON)
        $data =  json_decode($response, true);
        return json_decode($response, true)['records'];
    }

    public function get_en_progreso()
    {
        $apiUrl = 'http://localhost/api/todo/leer-en-progreso.php';
        // Realiza la petición GET a la API y obtén la respuesta
        $response = file_get_contents($apiUrl);
        // Decodifica la respuesta JSON (si la API devuelve datos en formato JSON)
        $data =  json_decode($response, true);
        return json_decode($response, true)['records'];
    }

    public function get_terminada()
    {
        $apiUrl = 'http://localhost/api/todo/leer-terminada.php';
        // Realiza la petición GET a la API y obtén la respuesta
        $response = file_get_contents($apiUrl);
        // Decodifica la respuesta JSON (si la API devuelve datos en formato JSON)
        $data =  json_decode($response, true);
        return json_decode($response, true)['records'];
    }

    public function edit($taskID, $taskTitle, $taskDescription, $taskStatus, $taskDueDate, $taskAssignee, $taskType)
    {
        $apiUrl = 'http://localhost/api/todo/edit.php';
        $postData = array(
            'id'          => $taskID,
            'titulo'      => $taskTitle,
            "descripcion" => $taskDescription ,
            "estado"      => $taskStatus ,
            "fecha"       => $taskDueDate ,
            "responsable" => $taskAssignee ,
            "tipo_tarea"  => $taskType ,
        );
        
        $jsonData = json_encode($postData);
        // Inicializa cURL
        $ch = curl_init($apiUrl);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        // Configura los encabezados para indicar que estás enviando datos JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Realiza la solicitud y obtén la respuesta
        $response = curl_exec($ch);
        
        // Verifica si la solicitud fue exitosa
        if ($response === false) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        } else {
                   return true;
        }
        
        // Cierra la sesión cURL
        curl_close($ch);
        return true;
    }

    public function insert_new($taskTitle, $taskDescription, $taskStatus, $taskDueDate, $taskAssignee, $taskType)
    {
        $apiUrl = 'http://localhost/api/todo/create.php';
        $postData = array(
            'titulo'      => $taskTitle,
            "descripcion" => $taskDescription ,
            "estado"      => $taskStatus ,
            "fecha"       => $taskDueDate ,
            "responsable" => $taskAssignee ,
            "tipo_tarea"  => $taskType ,
        );
        
        $jsonData = json_encode($postData);
        $ch = curl_init($apiUrl);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        
        if ($response === false) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        } else {
                   return true;
        }
        
        curl_close($ch);
        return true;
    }

    public function delete($id)
    {
        $apiUrl = 'http://localhost/api/todo/delete.php';
        $postData = array(
            'id'          => $id,

        );
        
        $jsonData = json_encode($postData);
        $ch = curl_init($apiUrl);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
        } else {
                   return true;
        }
                curl_close($ch);
        return true;
    }
}
