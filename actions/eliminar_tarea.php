<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\TareaController;

session_start();

if (!empty($_GET["idtarea"])) {
    $id = $_GET["idtarea"];
    $controller = new TareaController();
    $resultado = $controller->eliminar($id);

    $mensaje = $resultado
        ? '<div class="alert alert-success col-12">Tarea ' . htmlspecialchars($id) . ' Eliminada Correctamente</div>'
        : '<div class="alert alert-danger">Error al eliminar la tarea.</div>';

   
    $_SESSION['mensaje'] = $mensaje;
    header('Location: /gestion_tareas_crud/index.php');
    exit();
} else {
    // Manejar el caso donde no se proporciona el id
    $_SESSION['mensaje'] = '<div class="alert alert-danger">ID de tarea no proporcionado.</div>';
    header('Location: /gestion_tareas_crud/index.php');
    exit();
}
?>
