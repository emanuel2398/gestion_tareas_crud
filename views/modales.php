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
                <form id="deleteForm" method="GET" action="actions/eliminar_tarea.php">
                    <input type="hidden" id="delete_idtarea" name="idtarea">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteLink" class="btn btn-danger">Eliminar</a>
                </form>
            </div>
        </div>
    </div>
</div>
