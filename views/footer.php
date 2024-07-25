<!-- views/partials/footer.php -->
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
