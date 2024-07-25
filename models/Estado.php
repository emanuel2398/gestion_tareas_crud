<?php
namespace Models;


class Estado
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerEstados()
    {
        $stmt = $this->pdo->query("
            SELECT * FROM estado
            ORDER BY idestado DESC
        ");
        return $stmt->fetchAll();
    }
}
