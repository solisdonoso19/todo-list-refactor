<?php
require_once('config.php');
class ModeloBD
{
    protected $id;
    protected $titulo;
    protected $descripcion;
    protected $estado;
    protected $fecha;
    protected $editado;
    protected $responsable;
    protected $tipo_tarea;

    protected $_DB;
    public function __construct()
    {
        try {
            $this->_DB     = new
                mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            // echo '<script type="text/javascript">alert("DATABASE CONNECTED!");</script>';
        } catch (\Throwable $th) {
            // echo '<script type="text/javascript">alert("ERROR DATABASE CONNECTION");</script>';
        }
    }
}
// $this->id          = $id;
// $this->titulo      = $titulo;
// $this->descripcion = $descripcion;
// $this->estado      = $estado;
// $this->fecha       = $fecha;
// $this->editado     = $editado;
// $this->responsable = $responsable;
// $this->tipo_tarea  = $tipo_tarea;