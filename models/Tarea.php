<?php
namespace Models;


class Tarea
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerTareas()
    {
        $stmt = $this->pdo->query("
            SELECT t.idtarea, t.nombre_tarea, t.descripcion, e.descripcion AS estado, tt.descripcion AS tipo, u.nombre_apellido AS usuario, t.tarea_finalizada
            FROM tarea t
            JOIN estado e ON t.estado = e.idestado
            JOIN tipo_tarea tt ON t.tipo_tarea = tt.idtipo_tarea
            JOIN usuario u ON t.usuario_asignado = u.idusuario
            ORDER BY t.idtarea DESC
        ");
        return $stmt->fetchAll();
    }
    public function crearTarea($datos)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO tarea (nombre_tarea, descripcion, tipo_tarea, estado, usuario_asignado, tarea_finalizada)
            VALUES (:nombre_tarea, :descripcion, :tipo_tarea, :estado, :usuario_asignado, :tarea_finalizada)
        ");
        return $stmt->execute([
            'nombre_tarea' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'tipo_tarea' => $datos['tipo'],
            'estado' => $datos['estado'],
            'usuario_asignado' => $datos['usuario_asignado'],
            'tarea_finalizada' => $datos['finalizada']
        ]);
    }
    public function eliminarTarea($id){
        $stmt = $this->pdo->prepare("
        DELETE FROM tarea WHERE idtarea = :idtarea
        ");
        return $stmt->execute(['idtarea' => $id]);
    }
    public function actualizarTarea($id, $datos)
    {
        $stmt = $this->pdo->prepare("
            UPDATE tarea 
            SET nombre_tarea = :nombre_tarea, descripcion = :descripcion, tipo_tarea = :tipo_tarea, estado = :estado, usuario_asignado = :usuario_asignado, tarea_finalizada = :tarea_finalizada
            WHERE idtarea = :id
        ");
        return $stmt->execute([
            'nombre_tarea' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'tipo_tarea' => $datos['tipo'],
            'estado' => $datos['estado'],
            'usuario_asignado' => $datos['usuario_asignado'],
            'tarea_finalizada' => $datos['finalizada'],
            'id' => $id
        ]);
    }
    public function obtenerTareaPorId($idtarea)
    {
        $stmt = $this->pdo->prepare("
            SELECT idtarea, nombre_tarea, descripcion, tipo_tarea, estado, usuario_asignado, tarea_finalizada
            FROM tarea
            WHERE idtarea = :idtarea
        ");
        $stmt->execute(['idtarea' => $idtarea]);
        return $stmt->fetch();
    }
    

}
