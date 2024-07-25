<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\TareaController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'tipo' => $_POST['tipo'],
        'estado' => $_POST['estado'],
        'usuario_asignado' => $_POST['usuario_asignado'],
        'finalizada' => $_POST['finalizada']
    ];

    $controller = new TareaController();
    $resultado = $controller->crear($datos);

    $mensaje = $resultado
        ? '<div class="alert alert-success">Tarea Creada Correctamente</div>'
        : '<div class="alert alert-danger">Error al crear la tarea.</div>';

    session_start();
    $_SESSION['mensaje'] = $mensaje;
    header('Location: /gestion_tareas_crud/index.php');
    exit();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido.']);
}
?>
