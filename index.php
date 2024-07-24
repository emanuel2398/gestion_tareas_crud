<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></head>
<body>
    <div class="container-fluid row">
        <form class="col-3">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre Tarea</label>
                <input type="email" class="form-control" id="nombre" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Descripción</label>
                <input type="email" class="form-control" id="descripcion" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tipo Tarea</label>
                <input type="email" class="form-control" id="tipo" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Estado</label>
                <input type="email" class="form-control" id="estado" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario Asignado</label>
                <input type="email" class="form-control" id="usuario_asignado" >
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tarea Finalizada</label>
                <input type="email" class="form-control" id="finalizada" >
            </div>
            <button type="submit" class="btn btn-primary" name="btnCrear">Crear</button>
        </form>
        <div class="col-9 p-4">

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
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php include "models/database.php";
                     $stmt = $pdo->query("SELECT t.idtarea, t.nombre_tarea, t.descripcion, e.descripcion AS estado, tt.descripcion AS tipo, u.nombre_apellido AS usuario, t.tarea_finalizada
                     FROM tarea t
                     JOIN estado e ON t.estado = e.idestado
                     JOIN tipo_tarea tt ON t.tipo_tarea = tt.idtipo_tarea
                     JOIN usuario u ON t.usuario_asignado = u.idusuario");
                    foreach ($stmt as  $tarea) {
                    ?>
                     <tr>
                        <th scope="row"><?=$tarea['idtarea'] ?></th>
                        <td><?=$tarea['nombre_tarea'] ?></td>
                        <td><?=$tarea['descripcion'] ?></td>
                        <td><?=$tarea['estado'] ?></td>
                        <td><?=$tarea['tipo'] ?></td>
                        <td><?=$tarea['usuario'] ?></td>
                        <td><?= $tarea['tarea_finalizada'] == 1 ? 'Sí' : 'No' ?></td>
                        <td>
                        <a href="edit.php?id=1" class="text-warning"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=1" class="text-danger ml-2"><i class="fas fa-trash-alt"></i></a>
                
                        </td>
                    </tr>
                    <?php }?>
                   

                </tbody>
            </table>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>