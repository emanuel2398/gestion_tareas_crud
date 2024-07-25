<?php
namespace Models;


class TipoTarea
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerTipoTareas()
    {
        $stmt = $this->pdo->query("
            SELECT * FROM tipo_tarea
            ORDER BY idtipo_tarea DESC
        ");
        return $stmt->fetchAll();
    }
}
