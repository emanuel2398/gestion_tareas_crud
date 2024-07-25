<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\TareaController;
session_start();
if (isset($_GET['idtarea'])) {
    $controller = new TareaController();
    $tarea = $controller->obtenerTareaPorId($_GET['idtarea']);
    echo json_encode($tarea);
} else {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">Método no permitido.</div>';
}
?>
