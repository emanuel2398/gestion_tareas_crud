<?php
namespace Models;


class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerUsuarios()
    {
        $stmt = $this->pdo->query("
            SELECT * FROM usuario
            ORDER BY idusuario DESC
        ");
        return $stmt->fetchAll();
    }
}
