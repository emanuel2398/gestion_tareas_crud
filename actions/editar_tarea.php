<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\TareaController;
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TareaController();
    $id = $_POST['idtarea'];
    $datos = [
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'tipo' => $_POST['tipo'],
        'estado' => $_POST['estado'],
        'usuario_asignado' => $_POST['usuario_asignado'],
        'finalizada' => $_POST['finalizada']
    ];

    $resultado = $controller->actualizarTarea($id, $datos);

    $mensaje = $resultado
        ? '<div class="alert alert-success">Tarea Actualizada Correctamente</div>'
        : '<div class="alert alert-danger">Error al actualizar la tarea.</div>';

   
    $_SESSION['mensaje'] = $mensaje;
    header('Location: /gestion_tareas_crud/index.php');
    exit();
} else {

    $_SESSION['mensaje'] = '<div class="alert alert-danger">Método no permitido.</div>';
}
?>
