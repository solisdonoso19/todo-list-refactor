<?php
require_once('modelo.php');
class todo extends ModeloBD
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $query = 'SELECT * FROM checklist';
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
}
