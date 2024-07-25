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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
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
                        <th scope="row"><?= $tarea['idtarea'] ?></th>
                        <td><?= $tarea['nombre_tarea'] ?></td>
                        <td><?= $tarea['descripcion'] ?></td>
                        <td><?= $tarea['estado'] ?></td>
                        <td><?= $tarea['tipo'] ?></td>
                        <td><?= $tarea['usuario'] ?></td>
                        <td><?= $tarea['tarea_finalizada'] == 1 ? 'Sí' : 'No' ?></td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="abrirModalEdicion(<?= $tarea['idtarea'] ?>)"><i class="fas fa-edit"></i></button>
                            <a href="eliminar_tarea.php?idtarea=<?= $tarea['idtarea'] ?>" class="btn btn-danger ml-2" onclick="setDeleteId(<?= $tarea['idtarea'] ?>)" data-toggle="modal" data-target="#deleteModal">
        <i class="fas fa-trash-alt"></i>
    </a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Crear Tarea -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" method="POST" action="actions/crear_tarea.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Crear Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Tarea</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo Tarea</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <?php foreach ($tipos as $tipo) { ?>
                                <option value="<?= $tipo['idtipo_tarea'] ?>"><?= htmlspecialchars($tipo['descripcion']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <?php foreach ($estados as $estado) { ?>
                                <option value="<?= $estado['idestado'] ?>"><?= htmlspecialchars($estado['descripcion']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usuario_asignado" class="form-label">Usuario Asignado</label>
                            <select class="form-control" id="usuario_asignado" name="usuario_asignado" required>
                                <?php foreach ($usuarios as $usuario) { ?>
                                <option value="<?= $usuario['idusuario'] ?>"><?= htmlspecialchars($usuario['nombre_apellido']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="finalizada" class="form-label">Tarea Finalizada</label>
                            <select class="form-control" id="finalizada" name="finalizada" required>
                                <?php foreach ($finalizadas as $finalizada) { ?>
                                <option value="<?= $finalizada['id'] ?>"><?= htmlspecialchars($finalizada['nombre']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Tarea -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST" action="actions/editar_tarea.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_idtarea" name="idtarea">
                        <div class="mb-3">
                            <label for="edit_nombre" class="form-label">Nombre Tarea</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="edit_descripcion" name="descripcion" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tipo" class="form-label">Tipo Tarea</label>
                            <select class="form-control" id="edit_tipo" name="tipo" required>
                                <?php foreach ($tipos as $tipo) { ?>
                                <option value="<?= $tipo['idtipo_tarea'] ?>"><?= htmlspecialchars($tipo['descripcion']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_estado" class="form-label">Estado</label>
                            <select class="form-control" id="edit_estado" name="estado" required>
                                <?php foreach ($estados as $estado) { ?>
                                <option value="<?= $estado['idestado'] ?>"><?= htmlspecialchars($estado['descripcion']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_usuario_asignado" class="form-label">Usuario Asignado</label>
                            <select class="form-control" id="edit_usuario_asignado" name="usuario_asignado" required>
                                <?php foreach ($usuarios as $usuario) { ?>
                                <option value="<?= $usuario['idusuario'] ?>"><?= htmlspecialchars($usuario['nombre_apellido']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_finalizada" class="form-label">Tarea Finalizada</label>
                            <select class="form-control" id="edit_finalizada" name="finalizada" required>
                                <?php foreach ($finalizadas as $finalizada) { ?>
                                <option value="<?= $finalizada['id'] ?>"><?= htmlspecialchars($finalizada['nombre']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmación de Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="GET" action="eliminar_tarea.php">
                        <input type="hidden" id="delete_idtarea" name="idtarea">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="#" id="confirmDeleteLink" class="btn btn-danger">Eliminar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function abrirModalEdicion(idtarea) {
            $.ajax({
                url: 'actions/obtener_tarea.php',
                method: 'GET',
                data: { idtarea: idtarea },
                success: function(data) {
                    var tarea = JSON.parse(data);
                    $('#edit_idtarea').val(tarea.idtarea);
                    $('#edit_nombre').val(tarea.nombre_tarea);
                    $('#edit_descripcion').val(tarea.descripcion);
                    $('#edit_tipo').val(tarea.tipo_tarea);
                    $('#edit_estado').val(tarea.estado);
                    $('#edit_usuario_asignado').val(tarea.usuario_asignado);
                    $('#edit_finalizada').val(tarea.tarea_finalizada);
                    $('#editModal').modal('show');
                }
            });
        }
        

        function setDeleteId(idtarea) {
            var deleteLink = document.getElementById('confirmDeleteLink');
            deleteLink.href = 'actions/eliminar_tarea.php?idtarea=' + idtarea;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
