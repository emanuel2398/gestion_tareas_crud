<?php

namespace Controllers;

use Config\Database;
use Models\Estado;
use Models\Tarea;
use Models\TipoTarea;
use Models\Usuario;

class TareaController
{
    private $tarea;
    private $db;

    public function __construct()
    {  
        $this->db = (new Database())->getConnection();
        $this->tarea = new Tarea($this->db);
    }

    public function index()
    {
        return $this->tarea->obtenerTareas();
    }  
    public function crear($datos)
    {
        return $this->tarea->crearTarea($datos);
    }
    public function eliminar($id){
        return $this->tarea->eliminarTarea($id);
    }
    public function actualizarTarea($id, $datos)
    {
        return $this->tarea->actualizarTarea($id, $datos);
    }

    public function getEstados()
    {
        $estados=new Estado($this->db);
        return $estados->obtenerEstados();
    }
    public function getUsuarios()
    {
        $usuarios=new Usuario($this->db);
        return $usuarios->obtenerUsuarios();
    }
    public function getTipoTareas()
    {
        $tipoTareas=new TipoTarea($this->db);
        return $tipoTareas->obtenerTipoTareas();
    }
    public function obtenerTareaPorId($idtarea)
    {
        return $this->tarea->obtenerTareaPorId($idtarea);
    }

}
?>