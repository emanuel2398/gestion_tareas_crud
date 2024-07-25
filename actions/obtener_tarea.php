<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\TareaController;

if (isset($_GET['idtarea'])) {
    $controller = new TareaController();
    $tarea = $controller->obtenerTareaPorId($_GET['idtarea']);
    echo json_encode($tarea);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID de tarea no proporcionado.']);
}
?>
