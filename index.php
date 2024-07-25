<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controllers\TareaController;
session_start();
$controller = new TareaController();
$tareas = $controller->index();
$tipos = $controller->getTipoTareas(); 
$estados = $controller->getEstados();
$usuarios = $controller->getUsuarios(); 
$finalizadas = [
    ['id' => 1, 'nombre' => 'Sí'],
    ['id' => 0, 'nombre' => 'No']
];
?>
<?php include 'views/header.php'; ?>
<?php include 'views/modales.php'; ?>
<?php
    if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
?>
<div class="container-fluid row">
    <div class="col-12 p-4">
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createModal">Crear Tarea</button>
        
        <table class="table">
            <thead class="bg-info">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Tarea</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Finalizada</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea) { ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($tarea['idtarea']) ?></th>
                    <td><?= htmlspecialchars($tarea['nombre_tarea']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td><?= htmlspecialchars($tarea['estado']) ?></td>
                    <td><?= htmlspecialchars($tarea['tipo']) ?></td>
                    <td><?= htmlspecialchars($tarea['usuario']) ?></td>
                    <td><?= $tarea['tarea_finalizada'] == 1 ? 'Sí' : 'No' ?></td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="abrirModalEdicion(<?= htmlspecialchars($tarea['idtarea']) ?>)"><i class="fas fa-edit"></i></button>
                        <a href="eliminar_tarea.php?idtarea=<?= htmlspecialchars($tarea['idtarea']) ?>" class="btn btn-danger ml-2" onclick="setDeleteId(<?= htmlspecialchars($tarea['idtarea']) ?>)" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'views/footer.php'; ?>
